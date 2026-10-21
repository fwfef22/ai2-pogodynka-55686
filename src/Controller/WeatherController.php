<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'weather_city')]
    public function city(string $city, LocationRepository $locationRepository): Response
    {
        // Wyszukanie lokalizacji po nazwie miasta
        $location = $locationRepository->findOneBy(['city' => $city]);

        if (!$location) {
            throw $this->createNotFoundException('Nie znaleziono takiego miasta w bazie.');
        }

        return $this->render('weather/city.html.twig', [
            'location' => $location,
        ]);
    }
}