<?php

interface PostModelInterace {
    public function createPost($post_title, $post_body);
    public function displayPost();
}