<div class="form text-center">
    {!! Form::open(['action' => 'HomeController@solution']) !!}

    <h3><b>Tabela:</b></h3>
    <hr class="separator" />
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Base</th>
                <th>{!! implode('</th><th>', array_keys(current($table))) !!}</th>
            </tr>
      </thead>
      <tbody>
          @foreach ($table as $key => $row)
              <tr>
                  <td><b>{!! $key !!}</b></td>
                  <td>{!! implode('</td><td>', $row) !!}</td>
              </tr>
          @endforeach
      </tbody>
    </table>

    @include('partials.buttons')

    {!! Form::close() !!}
</div>
