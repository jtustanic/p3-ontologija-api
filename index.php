<?php
require 'vendor/autoload.php';
require 'bootstrap.php';
use Tustanic\Ontologija;
use Composer\Autoload\ClassLoader;

Flight::route('/', function(){
  $foaf = \EasyRdf\Graph::newAndLoad('https://oziz.ffos.hr/nastava20202021/jtustanic_20/ontologija/tustanic_ontologija.rdf');
  echo $foaf->dump();
});

Flight::route('GET /search', function(){

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij=$em->getRepository('Tustanic\Ontologija');

  $zapisi = $repozitorij->findAll();
  // var_dump($doctrineBootstrap->getJson($zapisi));
  // die();
  echo $doctrineBootstrap->getJson($zapisi);

});

Flight::route('GET /search/@ime_nakladnika', function($ime_nakladnika){

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij=$em->getRepository('Tustanic\Ontologija');
  $zapisi = $repozitorij->createQueryBuilder('i')
                        ->where('i.ime_nakladnika LIKE :ime_nakladnika')
                        ->setParameter('ime_nakladnika', '%' . $ime_nakladnika . '%')
                        ->getQuery()
                        ->getResult();
  echo $doctrineBootstrap->getJson($zapisi);

});

Flight::route('GET /unosPodataka', function(){

  $foaf = \EasyRdf\Graph::newAndLoad('https://oziz.ffos.hr/nastava20202021/jtustanic_20/ontologija/tustanic_ontologija.rdf');

  // print_r('test');
  // die();

  foreach ($foaf->resources() as $resource) {

    if($foaf->get($resource, '<http://oziz.ffos.hr/p3/jtustanic/zarada-knjige#ime_nakladnika>') != ''){

      $ime_nakladnika = ''.$foaf->get($resource, '<http://oziz.ffos.hr/p3/jtustanic/zarada-knjige#ime_nakladnika>');

      $mjesto_izdanja = ''.$foaf->get($resource, '<http://oziz.ffos.hr/p3/jtustanic/zarada-knjige#mjesto_izdanja>');

      $jePreveo = ''.$foaf->get($resource, '<http://oziz.ffos.hr/jtustanic/krj-ontologija#jePreveo>');

      $jePrevedeno = ''.$foaf->get($resource, '<http://oziz.ffos.hr/jtustanic/krj-ontologija#jePrevedeno>');

      $zaradioJe = ''.$foaf->get($resource, '<http://oziz.ffos.hr/jtustanic/krj-ontologija#zaradioJe>');

      $ontologija = new Ontologija();
      $ontologija->setPodaci(Flight::request()->data);

      $ontologija->setIme_nakladnika($ime_nakladnika);
      $ontologija->setMjesto_izdanja($mjesto_izdanja);
      $ontologija->setJePreveo($jePreveo);
      $ontologija->setJePrevedeno($jePrevedeno);
      $ontologija->setZaradioJe($zaradioJe);

      $doctrineBootstrap = Flight::entityManager();
      $em = $doctrineBootstrap->getEntityManager();

      $em->persist($ontologija);
      $em->flush();
    }

  }

  echo "Podaci su uspješno uneseni u bazu!";
});

$cl = new ClassLoader('Tustanic', __DIR__, '/src');
$cl->register();

require_once 'bootstrap.php';
Flight::register('entityManager', 'DoctrineBootstrap');

Flight::start();
