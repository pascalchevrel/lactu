<?php

require_once 'GuzzleHarness.php';

class InstallTest extends GuzzleHarness {

    public function setUp(): void
    {
        parent::setUp();
        removeCustomFiles();
    }

    public function tearDown():void
    {
        parent::tearDown();
        removeCustomFiles();
    }

    private function getBodyAsString(mixed $body): string
    {
        return ((array) (string) $body)[0];
    }

    public function test_index_page_tells_lactu_is_not_installed():void
    {
        $res = $this->client->get('/index.php');
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertStringContainsString(
            'install Lactu',
            $this->getBodyAsString($res->getBody())
        );
    }

    public function test_install_page_loads_without_error():void
    {
        $res = $this->client->get('/install.php');
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertStringContainsString(
            'Administrator password',
            $this->getBodyAsString($res->getBody())
        );
    }

    /**
     * Regression test, `people.opml` was created by requesting `/install.php`
     * even if the site was not installed: `touch()` was called to see if
     * the path was writable but the file was not removed.
     */
    public function test_get_install_page_should_not_create_custom_files():void
    {
        $this->client->get('/install.php');
        $this->assertFalse(file_exists(custom_path('people.opml')));
        $this->assertFalse(file_exists(custom_path('config.yml')));
        $this->assertFalse(file_exists(custom_path('inc/pwc.inc.php')));
    }

    public function test_install_button():void
    {
        $data = [
            'url' => 'http://127.0.0.1:8081/',
            'title'	=> 'My website',
            'password' => 'admin',
            'locale' => 'en',
        ];

        $res = $this->client->request('POST', '/install.php', [
            'form_params' => $data
        ]);
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertStringContainsString(
            'Your Lactu is ready.',
            $this->getBodyAsString($res->getBody())
        );
    }
}