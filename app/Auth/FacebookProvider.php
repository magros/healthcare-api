<?php
namespace App\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FacebookProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * The base Facebook Graph URL.
     *
     * @var string
     */
    protected $graphUrl = 'https://graph.facebook.com';
    /**
     * The Graph API version for the request.
     *
     * @var string
     */
    protected $version = 'v4.0';

    /**
     * The user fields being requested.
     *
     * @var array
     */
    protected $fields = ['name', 'email', 'gender', 'verified', 'link'];

    /**
     * FacebookProvider constructor.
     * @param $token
     */
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $meUrl = $this->graphUrl.'/'.$this->version.'/me?access_token='.$token.'&fields='.implode(',', $this->fields);

        $response = $this->getHttpClient()->get($meUrl, [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        $avatarUrl = $this->graphUrl.'/'.$this->version.'/'.$user['id'].'/picture';
        return (new User)->setRaw($user)->map([
            'id' => $user['id'],
            'nickname' => null,
            'name' => $user['name'] ?? null,
            'email' => $user['email'] ?? null,
            'avatar' => $avatarUrl.'?type=normal',
            'avatar_original' => $avatarUrl.'?width=1920',
            'profileUrl' => $user['link'] ?? null,
        ]);
    }
}
