@include('dns.contenedores.search')
<table class="table table-bordered table-condensed">
<tbody>
  <div class="row">
  @foreach($result as $key => $dnsinfo)
  <tr  data-nombre="{{$dnsinfo->company}}">
    <td class="col-server col-md-8">
        <div class="location">{{$dnsinfo->country}}</div>
        <div class="provider">{{$dnsinfo->company}}</div>
    </td>
    <td class="col-result col-md-8 text-right">
      <div class="result" id='{{$dnsinfo->id}}' ></div>
      <span class="msg" id='msg{{$dnsinfo->id}}'></span>
      <span class="loading" id='loading{{$dnsinfo->id}}'></span>
    </td>
    <td class="col-status col-md-4 text-right">
      <div class="status" id='status{{$dnsinfo->id}}'>
      <span class="glyphicon glyphicon-record"></span></div>
    </td>
  </tr>
  @endforeach
  </div>
  </tbody>
</table>
<input type="hidden" name="_token" value="{{{ csrf_token() }}}" id='_token'/>
