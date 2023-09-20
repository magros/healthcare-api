<?php

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    private $apiToken;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }


    public function createUser($data = [])
    {
        $user = factory(\App\User::class)->create($data);
        $user->patient()->create();
        return $user;
    }

    public function createPatient($data = [])
    {
        return factory(\App\Models\Patient::class)->create($data);
    }

    public function makePost($url, $params = [], $headers = [])
    {
        if ($this->apiToken) {
            $headers['Authorization'] = "Bearer " . $this->apiToken;
        }
        $response = $this->post($url, $params, $headers);
        $this->seeStatusCode(200);

        return json_decode($response->response->getContent())->data;

    }

    public function makePut($url, $params = [], $headers = [])
    {
        if ($this->apiToken) {
            $headers['Authorization'] = "Bearer " . $this->apiToken;
        }
        $response = $this->put($url, $params, $headers);
        $this->seeStatusCode(200);

        return json_decode($response->response->getContent())->data;
    }

    public function authenticate($user = null)
    {
        if (!$user) {
            $user = $this->createUser();
        }
        $this->apiToken = $user->api_token;

        return $this;
    }

    public function makeGet($url, $params = [], $headers = [])
    {
        if ($this->apiToken) {
            $headers['Authorization'] = "Bearer " . $this->apiToken;
        }
        $response = $this->get("$url?".http_build_query($params), $headers);

        $response->seeStatusCode(200);

        return json_decode($response->response->getContent())->data;
    }

    public function makeDelete($url, $data = [], $headers = [])
    {
        if ($this->apiToken) {
            $headers['Authorization'] = "Bearer " . $this->apiToken;
        }
        $response = $this->delete("$url", $data, $headers);

        $response->seeStatusCode(200);

        return json_decode($response->response->getContent())->data;
    }

    public function seedDatabase()
    {
        \Illuminate\Support\Facades\Artisan::call('db:seed');
    }
}
