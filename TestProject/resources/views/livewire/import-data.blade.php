<table class="table">
    <thead>
        <tr>
            <th>Excel Header</th>
            <th>Table</th>
            <th>Column</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($headers as $item)
            <tr>
                <td>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"
                                name="import['table'][]" id="" value="{{ $item }}">
                            {{ $item }}
                        </label>
                    </div>
                </td>
                <td>
                    <select class="form-control" name="import['table'][]" id="">
                        <option value="">---</option>
                        @foreach ($tables as $key => $table)
                            <option value="{{ $table }}">{{ $table }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control" name="import['table'][]" id="">
                        <option value="">---</option>
                        @foreach ($tables as $key => $table)
                            <option value="{{ $table }}">{{ $table }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>