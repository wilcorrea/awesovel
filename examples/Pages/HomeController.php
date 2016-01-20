<?php

namespace Delivery\Src\Pages;

use Delivery\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * @var bool
     */
    protected $header = true;

    /**
     * @var bool
     */
    protected $banner = true;

    /**
     * HomeController constructor.
     *
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * @param $route
     * @param $language
     * @param $input
     * @param $parameters
     *
     * @return object
     */
    public function page($route, $language, $input, $parameters = [])
    {

        $page = (object)[
            'header' => $this->header,
            'banner' => $this->banner,
            'parameters' => $parameters,
            'menu' => $this->menu($route, $language, $input),
            'data' => $this->data($route, $language, $input),
        ];

        return $page;
    }

    /**
     * @param $route
     * @param $language
     * @param $input
     *
     * @return array
     */
    protected function menu($route, $language, $input)
    {
        $menu = [
            (object)['href' => 'concursos/em-andamento', 'label' => 'Em Andamento'],
            (object)['href' => 'concursos/inscricoes-abertas', 'label' => 'Inscrições Abertas'],
            (object)['href' => 'concursos/novos', 'label' => 'Novos'],
            (object)['href' => 'concursos/encerrados', 'label' => 'Encerrados'],
            (object)['href' => 'fale-conosco', 'label' => 'Fale Conosco'],
        ];

        return $menu;
    }

    /**
     * @param $route
     * @param $language
     * @param $input
     *
     * @return array
     */
    protected function data($route, $language, $input)
    {

        return [
            'Em Andamento' => ['Tribunal de Justiça de Minas Gerais - TJMG - Concurso Extrajudicial - 02.2015',
                'Faculdade de Medicina de Olinda / PE - Vestibular de Medicina - 1º Semestre 2016',
                'Corpo de Bombeiros Militar do Pará - CBMPA / CFP',
                'Corpo de Bombeiros Militar do Pará - CBMPA / CFO',
                'Prefeitura Municipal de Patos de Minas/MG',
                'Prefeitura de Ibiraçu/ES',
                'Tribunal de Justiça de Minas Gerais - TJMG - Concurso Extrajudicial - 01.2014',
                'Tribunal de Justiça de Minas Gerais - TJMG - Concurso Extrajudicial - 01.2015',
                'Corpo de Bombeiros Militar de Santa Catarina - CBMSC',
                'Tribunal de Justiça de Minas Gerais - TJMG - Juiz Leigo',
                'Vestibular 2016/1- Medicina - FAMINAS - Campus BH',
                'Vestibular 2016/1 - Medicina - FAMINAS - Muriaé']

            , 'Inscriçoes Abertas' => [
                'FAGOC - Faculdade Governador Ozanam Coelho - Vestibular de Medicina - 2º Semestre 2015',
                'PISA / INEP / MEC 2015']
            ,
            'Encerrados' => ['Vestibular 2015/1 - Medicina - FAMINAS - Muriaé',
                'Vestibular 2015/1- Medicina - FAMINAS - Campus BH',
                'Vestibular UERN 2015/RN',
                'Vestibular 2014/2 - Medicina - FAMINAS - Muriaé',
                'CBTU - Companhia Brasileira de Trens Urbanos',
                'Companhia Imobiliária de Brasília – TERRACAP/DF',
                'MAPA - Ministério da Agricultura, Pecuária e Abastecimento',
                'Faculdade São Lucas / Porto Velho (RO) - Vestibular (Medicina) - 1° SEMESTRE – 2016',
                'Faculdade de Medicina de Olinda / PE - Vestibular de Medicina',
                'FAGOC - Faculdade Governador Ozanam Coelho - Vestibular de Medicina - 1º Semestre 2016',
                'Vestibular de Medicina 2016 - Faculdade Dinâmica - Ponte Nova / MG',
                'Prefeitura de Duque de Caxias / RJ',
                'Vestibular de Medicina 2015 - Faculdade Dinâmica - Ponte Nova / MG',
                'Vestibular 2015/2 - Medicina - FAMINAS - Campus BH',
                'Prefeitura Municipal de Juatuba/MG - Concurso Público',
                'Instituto Nacional de Meteorologia - Ministério da Agricultura - MAPA/INMET',
                'Tribunal Regional Eleitoral de Minas Gerais - TRE/MG (Técnico Judiciário)']];
    }


}
