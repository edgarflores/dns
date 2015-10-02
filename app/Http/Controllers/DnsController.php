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

    public function show()
    {
    //   $result = dns_get_record("infranetworking.com",DNS_NS);
    //
    // foreach ($result as $key => $value) {
    //   dd(gethostbyname($value['target']));
    // }

    $nscompany = [
      'Mountain View CA - Google, United States',
      'Level 3 Communications INC, United States',
      'Multinet, Afghanistan',
      'Cyberprog Network, United Kingdom',
      'Aspire Technology Solutions, United Kingdom',
      'UNIFONE NEW ZEALAND LTD, New Zealand',
      'HDNETNZ, New Zealand'
      ];

      $ip=[
        '8.8.8.8',
        '209.244.0.3',
        '202.86.16.86',
        '193.26.23.152',
        '178.23.129.210',
        '182.54.161.43',
        '49.50.247.180'
        ];

      $url=$_GET['url'];
      $type=$_GET['type'];
      $hostname = gethostbyaddr('8.8.8.8');
      $hostname1 = gethostbyname('infranetworking.com');

      /*
      * Validamos los datos para el tipo de registro
      */
      if ($type=='A') {
        $parametro='Address';
        $delimiter=':';
      }elseif ($type=='AAAA') {
        $parametro='';
        $delimiter='';
      }elseif ($type=='CNAME') {
        $parametro='';
        $delimiter='';
      }elseif($type=='MX') {
        $parametro='mail';
        $delimiter='=';
      }elseif ($type=='NS') {
        $parametro='name';
        $delimiter='=';
      }elseif ($type=='PTR') {
        $parametro='';
        $delimiter='';
      }elseif ($type=='SOA') {
        $parametro='';
        $delimiter='';
      }elseif ($type=='SRV') {
        $parametro='';
        $delimiter='';
      }elseif ($type=='TXT') {
        $parametro='text';
        $delimiter='"';
      }else {
        $parametro='';
        $delimiter='';
      }
      // $test=[];
      // foreach ($ip as $key => $ipns) {
      //   $idip=$ipns;
      //   $nslookup = ('nslookup -type='.$type.' '.$url.' '.$ipns.' | grep '.$parametro.' | cut -d "'.$delimiter.'" -f2 | egrep -v '.$ipns.'#53');
      //
      //    exec($nslookup, $result[$ipns]);
      //
      //
      // }

      //  dd($result);
      // $nslookup = ('nslookup -type='.$type.' '.$url.' '.$ip.' | grep '.$parametro.' | cut -d "'.$delimiter.'" -f2 | egrep -v '.$ip.'#53');
      $nslookup = ('dig '.$type.' '. $url .' 8.8.8.8 +short');
      $nslookup2 = ('dig '.$type.' '. $url .' 209.244.0.3 +short');
      $nslookup3 = ('dig '.$type.' '. $url .' 202.86.16.86 +short');


      $nslookup4 = ('nslookup -type='.$type.' '. $url.' 193.26.23.152 | grep '.$parametro.' | cut -d "'.$delimiter.'" -f2 | egrep -v 193.26.23.152#53');
      $nslookup5 = ('nslookup -type='.$type.' '. $url.' 178.23.129.210 | grep '.$parametro.' | cut -d "'.$delimiter.'" -f2 | egrep -v 178.23.129.210#53');
      $nslookup6 = ('nslookup -type='.$type.' '. $url.' 182.54.161.43 | grep '.$parametro.' | cut -d "'.$delimiter.'" -f2 | egrep -v 182.54.161.43#53');
      $nslookup7 = ('nslookup -type='.$type.' '. $url.' 49.50.247.180 | grep '.$parametro.' | cut -d "'.$delimiter.'" -f2 | egrep -v 49.50.247.180#53');
      // nslookup -type=AAAA google.com 8.8.8.8
      // nslookup -type=mx google.com 8.8.8.8 | grep mail | cut -d '=' -f2
      // nslookup -type=ns google.com 8.8.8.8 | grep name | cut -d '=' -f2
      // nslookup -type=soa google.com 8.8.8.8
      // nslookup -type=txt google.com 8.8.8.8 | grep text | cut -d '"' -f2

      exec($nslookup, $result);
      exec($nslookup2, $result2);
      exec($nslookup3, $result3);
      exec($nslookup4, $result4);
      exec($nslookup5, $result5);
      exec($nslookup6, $result6);
      exec($nslookup7, $result7);

      // dd($result);
    //  return view('dns/index',['result'=>$result, 'result2'=>$result2, 'result3'=>$result3, 'result4'=>$result4, 'result5'=>$result5, 'result6'=>$result6, 'result7'=>$result7]);
    $display= [
      'result'=>$result,
      'result2'=>$result2,
      'result3'=>$result3,
      'result4'=>$result4,
      'result5'=>$result5,
      'result6'=>$result6,
      'result7'=>$result7
      ];

      echo json_encode($display);
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

}
