<?php
namespace App\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use GuzzleHttp\ClientInterface;
use Illuminate\Http\RedirectResponse;

abstract class AbstractProvider
{
    protected $token;

    /**
     * The HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * The type of the encoding in the query.
     *
     * @var int Can be either PHP_QUERY_RFC3986 or PHP_QUERY_RFC1738.
     */
    protected $encodingType = PHP_QUERY_RFC1738;

    /**
     * The custom Guzzle configuration options.
     *
     * @var array
     */
    protected $guzzle = [];

    /**
     * Create a new provider instance.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string  $token
     * @return array
     */
    abstract protected function getUserByToken($token);
    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param  array  $user
     * @return User
     */
    abstract protected function mapUserToObject(array $user);

    /**
     * {@inheritdoc}
     */
    public function user(): User
    {
        $user = $this->mapUserToObject($this->getUserByToken($this->token));

        return $user;
    }

    /**
     * Get a instance of the Guzzle HTTP client.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getHttpClient()
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = new Client($this->guzzle);
        }
        return $this->httpClient;
    }


    public function login(): \App\User
    {
        $providerUser = $this->user();

        if($user = \App\User::where('email', $providerUser->getEmail())->first()){
            return $user;
        }

        return $this->register($providerUser);

    }

    /**
     * @param User $providerUser
     * @return \App\User
     */
    protected function register(User $providerUser): \App\User
    {
        $user = \App\User::create([
            'email' => $providerUser->getEmail(),
            'name' => $providerUser->getName(),
            'password'=> Hash::make(Str::random(16))
        ]);

        if($avatar = $providerUser->getAvatar()){
            $fileName = "avatar-user-{$user->id}";
            Storage::put('avatars/' . $fileName, file_get_contents($avatar));
            $user->avatar = $fileName;
            $user->update();
        }
        $user->patient()->create([]);

        return $user;
    }
}
