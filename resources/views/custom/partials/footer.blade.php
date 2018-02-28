
<footer >
 <h3 class="text-center">this is footer</h3>
 <div class="row">

   <div class="col-sm-4">
    <h4>Visitors Block</h4>

    <h5>Online Visitors Number: {{ $visitorsNumber }}</h5>
    <h5>Online Members Number: {{ $onlineMembersNumber }}</h5>
   </div>

   <div class="col-sm-4">
    <h4>Statistic Block</h4>

    <h5>Responses Number: {{ $responsesNumber }}</h5>
    <h5>Members number: {{ $membersNumber }}</h5>

    @if($lastMember)
      <h5>Latast  register Member: {{ $lastMember->name }}</h5>
    @endif


    @if ($visitsRecord)
     <h5>Visits Record Number:{{ $visitsRecord->visits_record }}  Time:{{ $visitsRecort->added_at }} </h5>

     @endif

   </div>
 </div>
</footer>