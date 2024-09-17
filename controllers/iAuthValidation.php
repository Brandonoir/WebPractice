<?php

interface AuthValidationInterface {
    public function validate(array $authData): bool;
    public function getValidateErrors();
}