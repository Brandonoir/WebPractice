<?php

interface IEmailVerify {
    public function isEmailUnique($email);
}