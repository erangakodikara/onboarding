<?php
namespace onboard\src\controller;

interface BaseControllerI
{
public function index();
public function run($action);
public function view($view,$data);

}