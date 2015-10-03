<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dnschecker;


class DnsController extends Controller
{


    public function index(){

      $dns = Dnschecker::get();
      return view('dns/index',['result' => $dns]);
    }


    public function search()
    {
      $domain=$_POST['url'];
      $parametro=$_POST['type'];

      $dns = Dnschecker::get();

      foreach ($dns as $key => $value) {

        $nslookup = ('dig '.$parametro.' '. $domain .' @'.$value->ip .' +short');

        exec($nslookup, $result[$value->id]);

      }

      echo json_encode($result);

    }

    public function net2(){

      $dns = Dnschecker::get();
      $data=[];
      $data2=[];
      $parametro='TXT';
      $show='';
      foreach ($dns as $key => $value) {
        $r = new \Net_DNS2_Resolver(array('nameservers' => array($value->ip)));

          try
          {
              $result = $r->query('infranetworking.com', $parametro);



              foreach($result->answer as $record)
              {
              if($parametro == 'A' || $parametro == 'AAAA'){
                $show=$record->address;
              }elseif ($parametro == 'CNAME') {
                $show=$record;
              }elseif($parametro=='MX'){
                $show=$record->preference.' '.$record->exchange;
              }elseif ($parametro == 'NS') {
                $show=$record->nsdname;
              }elseif ($parametro == 'PTR') {
                $show=$record;
              }elseif ($parametro == 'SOA') {
                $show=$record->mname;
              }elseif ($parametro == 'SRV') {
                $show=$record;
              }elseif ($parametro == 'TXT') {
                $show=$record->text;
              }
                  print_r($show);
                  $data[]=$show;
              }

          } catch(\Net_DNS2_Exception $e)
          {
              // echo "::query() failed: ", $e->getMessage(), "\n";
              $data[]= $e->getMessage();
          }
          $data2[$value->id]=$data;
          $data='';
      }
      dd($data2);
    }

}
