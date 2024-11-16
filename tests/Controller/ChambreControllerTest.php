<?php

namespace App\Tests\Controller;

use App\Entity\Chambre;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ChambreControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/chambre/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Chambre::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Chambre index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'chambre[nb_lits]' => 'Testing',
            'chambre[prix]' => 'Testing',
            'chambre[etage]' => 'Testing',
            'chambre[style]' => 'Testing',
            'chambre[etat]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Chambre();
        $fixture->setNb_lits('My Title');
        $fixture->setPrix('My Title');
        $fixture->setEtage('My Title');
        $fixture->setStyle('My Title');
        $fixture->setEtat('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Chambre');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Chambre();
        $fixture->setNb_lits('Value');
        $fixture->setPrix('Value');
        $fixture->setEtage('Value');
        $fixture->setStyle('Value');
        $fixture->setEtat('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'chambre[nb_lits]' => 'Something New',
            'chambre[prix]' => 'Something New',
            'chambre[etage]' => 'Something New',
            'chambre[style]' => 'Something New',
            'chambre[etat]' => 'Something New',
        ]);

        self::assertResponseRedirects('/chambre/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNb_lits());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getEtage());
        self::assertSame('Something New', $fixture[0]->getStyle());
        self::assertSame('Something New', $fixture[0]->getEtat());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Chambre();
        $fixture->setNb_lits('Value');
        $fixture->setPrix('Value');
        $fixture->setEtage('Value');
        $fixture->setStyle('Value');
        $fixture->setEtat('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/chambre/');
        self::assertSame(0, $this->repository->count([]));
    }
}
