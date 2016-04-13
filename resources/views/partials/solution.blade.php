<div class="form text-center">
    {!! Form::open([]) !!}

    <h3><b>Solução:</b></h3>
    <hr class="separator" />
    <table class="table table-hover table-solution">
        <thead>
            <tr>
                <th>Váriavel</th>
                <th>Valor</th>
            </tr>
      </thead>
      <tbody>
          @foreach ($solution as $key => $row)
              <tr>
                  <td>{!! $key !!}</td>
                  <td>{!! $row !!}</td>
              </tr>
          @endforeach
      </tbody>
    </table>

    @include('partials.buttons')

    {!! Form::close() !!}
</div>
