

 <h2>this is footer</h2>

<div>
 <h3>Visitors Block</h3>

 <h4> Online Visitors Number: {{ $visitorsNumber }}</h4>
 <h4>Online Members Number: {{ $onlineMembersNumber }}</h4>
</div>

<div>
 <h3>Statistic Block</h3>

<h4>Responses Number: {{ $responsesNumber }}</h4>
 <h4>Members number: {{ $membersNumber }}</h4>

 @if($lastMember)
   <h4>Latast  register Member: {{ $lastMember->name }}</h4>
@endif


 @if ($visitsRecord)
  <h4>Visits Record Number:{{ $visitsRecord->visits_recort }}  Time:{{ $visitsRecort->added_at }} </h4>

  @endif

</div>