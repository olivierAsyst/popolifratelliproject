<?php

namespace App\Test\Controller;

use App\Entity\StudentBook;
use App\Repository\StudentBookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentBookControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private StudentBookRepository $repository;
    private string $path = '/student/book/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(StudentBook::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('StudentBook index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'student_book[title]' => 'Testing',
            'student_book[description]' => 'Testing',
            'student_book[studentFullName]' => 'Testing',
            'student_book[year]' => 'Testing',
            'student_book[fileUrl]' => 'Testing',
            'student_book[filiere]' => 'Testing',
        ]);

        self::assertResponseRedirects('/student/book/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new StudentBook();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStudentFullName('My Title');
        $fixture->setYear('My Title');
        $fixture->setFileUrl('My Title');
        $fixture->setFiliere('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('StudentBook');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new StudentBook();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStudentFullName('My Title');
        $fixture->setYear('My Title');
        $fixture->setFileUrl('My Title');
        $fixture->setFiliere('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'student_book[title]' => 'Something New',
            'student_book[description]' => 'Something New',
            'student_book[studentFullName]' => 'Something New',
            'student_book[year]' => 'Something New',
            'student_book[fileUrl]' => 'Something New',
            'student_book[filiere]' => 'Something New',
        ]);

        self::assertResponseRedirects('/student/book/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getStudentFullName());
        self::assertSame('Something New', $fixture[0]->getYear());
        self::assertSame('Something New', $fixture[0]->getFileUrl());
        self::assertSame('Something New', $fixture[0]->getFiliere());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new StudentBook();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStudentFullName('My Title');
        $fixture->setYear('My Title');
        $fixture->setFileUrl('My Title');
        $fixture->setFiliere('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/student/book/');
    }
}
