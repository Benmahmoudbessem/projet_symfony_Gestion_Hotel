<?php

namespace App\Tests\Controller;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ReservationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/reservation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Reservation::class);

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
        self::assertPageTitleContains('Reservation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'reservation[num_reservation]' => 'Testing',
            'reservation[jour_Arr]' => 'Testing',
            'reservation[nb_jours]' => 'Testing',
            'reservation[jour_Dep]' => 'Testing',
            'reservation[reservEtat]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservation();
        $fixture->setNum_reservation('My Title');
        $fixture->setJour_Arr('My Title');
        $fixture->setNb_jours('My Title');
        $fixture->setJour_Dep('My Title');
        $fixture->setReservEtat('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reservation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservation();
        $fixture->setNum_reservation('Value');
        $fixture->setJour_Arr('Value');
        $fixture->setNb_jours('Value');
        $fixture->setJour_Dep('Value');
        $fixture->setReservEtat('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reservation[num_reservation]' => 'Something New',
            'reservation[jour_Arr]' => 'Something New',
            'reservation[nb_jours]' => 'Something New',
            'reservation[jour_Dep]' => 'Something New',
            'reservation[reservEtat]' => 'Something New',
        ]);

        self::assertResponseRedirects('/reservation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNum_reservation());
        self::assertSame('Something New', $fixture[0]->getJour_Arr());
        self::assertSame('Something New', $fixture[0]->getNb_jours());
        self::assertSame('Something New', $fixture[0]->getJour_Dep());
        self::assertSame('Something New', $fixture[0]->getReservEtat());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservation();
        $fixture->setNum_reservation('Value');
        $fixture->setJour_Arr('Value');
        $fixture->setNb_jours('Value');
        $fixture->setJour_Dep('Value');
        $fixture->setReservEtat('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/reservation/');
        self::assertSame(0, $this->repository->count([]));
    }
}
