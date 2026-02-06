<?php

test('user social auth routes reject invalid providers', function () {
    $this->get('/auth/invalid')->assertNotFound();
    $this->get('/auth/invalid/callback')->assertNotFound();
});
