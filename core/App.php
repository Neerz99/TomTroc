<?php

class App
{
    private static ?EntityManager $em = null;

    public static function setEntityManager(EntityManager $em): void { self::$em = $em; }

    public static function em(): EntityManager
    {
        if (!self::$em) throw new RuntimeException('EntityManager non initialisé');
        return self::$em;
    }
}
