<?php

namespace ADM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ADM\CoreBundle\Entity\Country;

class CountryController extends Controller
{
    public function readAction(Country $country)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $countryRepository = $em->getRepository('ADMCoreBundle:Country');

        $url="http://data.fao.org/developers/api/v1/fr/resources/faostat/crop-prod/facts.json?page=1&pageSize=500&filter=cnt.iso3%20eq%20BRA&fields=cnt.iso3%20AS%20iso3%2C%20year%2C%20item%20AS%20crop%2C%20m5419%20as%20Production";
        $json = file_get_contents($url);
        $json = json_decode($json, true);
        $json = $json['result'];
        $json = $json['list'];
        $json = $json['items'];
        $FAOdata = json_encode($json);


        return $this->render(
            'ADMCoreBundle:Country:read.html.twig',
            array(
                'country' => $country,
                'FAOdata' => $FAOdata
            )
        );
    }

}
