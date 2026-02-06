<?php

test('it defaults to light appearance on first visit', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee("const appearance = 'light'", false);
});
