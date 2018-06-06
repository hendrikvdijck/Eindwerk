@extends('layouts.app')
@section('content')
  <script>
    var tactic = @json($tactic);
    var team = @json($team);
    var coordinates = @json($coordinates);
    var max = @json($max);
  </script>
  <script type="text/javascript" src="{{ asset('js/canvas.js') }}"></script>
  <div class="row">
    <div class="col-6">
      <input type="number" name="step" id="step" value="1" onchange="updateStep()" min="1" max="{{$max+1}}">
      <button onclick="runSteps('{{$max}}')">Play!</button>
      <button onclick="resetSteps()">Reset steps</button>
      <canvas id="soccerfield" height="410" width="272" oncontextmenu="return false" style="background: #DDDDDD;" onload="onLoad()"></canvas>
    </div>
    <div class="col-6">
      <div class="row">
        <p>Right click on item to remove</p>
      </div>
      <div class="row">
        <form id="formCoordinates" action="/tactics/addCoordinates" method="post" style="border: 1px solid black">
          @if (session('error'))
            <div class="error">
              <p>{{ session('error') }}</p>
            </div>
          @endif
          @if (session('succes'))
            <div class="succes">
              <p>{{ session('succes') }}</p>
            </div>
          @endif
          @csrf
          <input type="hidden" name="tacticID" value="{{ $tactic->id }}">
          <p>Coördinaten toevoegen aan tactiek: {{ $tactic->tacticName }}</p>
          <p>Speler die je een coördinaat wil geven:</p>
          <select name="playerID" id="playerIDForm">
            @foreach($tactic->players as $player)
              <option value="{{ $player->id }}">{{ $player->firstName.' '.$player->lastName }}</option>
            @endforeach
          </select>
          <input type="hidden" name="x" id="xCoordinate">
          <input type="hidden" name="y" id="yCoordinate">
          <input type="hidden" name="step" id="formStep">
        </form>
      </div>
      <div class="row">

        <form id="removeCoordinates" action="{{ url('tactics/removeCoordinates')}}" method="post">
          @if (session('succesRemove'))
            <div class="succes">
              <p>{{ session('succesRemove') }}</p>
            </div>
          @endif
          @csrf
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="tacticID" value="{{ $tactic->id }}">
          <input type="hidden" name="x" id="xCoordinateDelete">
          <input type="hidden" name="y" id="yCoordinateDelete">
          <input type="hidden" name="step" id="formStepDelete">
          <p>verwijderen</p>
      </form>
      </div>
    </div>
  </div>

  <h6>Tactiek: {{ $tactic->tacticName }}</h6>
  <p>{{ $tactic->tacticDescription }}</p>
  @if($tactic->players)
    @foreach($tactic->players as $player)
      <li>{{ $player->firstName.' '.$player->lastName }}</li>
        <h6>Coordinates:</h6>
        @foreach($tactic->playersInTactic as $playerIT)
          @if($playerIT->FKplayerID == $player->id)
            @foreach($playerIT->coordinates as $coordinate)
              <p>id.{{ $coordinate->step.' '.$coordinate->xCoordinate.' '.$coordinate->yCoordinate }}</p>
            @endforeach
          @endif
        @endforeach
    @endforeach
  @endif

  <form action="/tactics/addPlayer" method="post" style="border: 1px solid black">
    @if (session('error'))
      <div class="error">
        <p>{{ session('error') }}</p>
      </div>
    @endif
    @if (session('succes'))
      <div class="succes">
        <p>{{ session('succes') }}</p>
      </div>
    @endif
    @csrf
    <input type="hidden" name="tacticID" value="{{ $tactic->id }}">
    <p>Speler toevoegen aan tactiek: {{ $tactic->tacticName }}</p>
    <p>Speler die je wilt toevoegen:</p>
    <select name="playerID" id="playerID">
      @foreach($team->players as $player)
        <option value="{{ $player->id }}">{{ $player->firstName.' '.$player->lastName }}</option>
      @endforeach
    </select>
    <button type="submit">Toevoegen</button>
  </form>
@endsection