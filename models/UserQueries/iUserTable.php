<?php

interface IUserTable {
    public function checkUsersTableExists();
    public function createUsersTable();
}