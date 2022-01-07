<!doctype html>
<html lang="en">

<head>
    <title>Import Data</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @livewireStyles

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Import Data</h1>
            </div>
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body table-responsive">
                        <form action="" method="post">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Excel Header</th>
                                        <th>Table</th>
                                        <th>Column</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($headers as $index => $item)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="import[excel][row_{{$index}}]" id="" value="{{ $item }}">
                                                        {{ $item }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-control" onchange="tableChanged(this,event)"
                                                    name="import[table][row_{{$index}}]" id="">
                                                    <option value="">---</option>
                                                    @foreach ($tables as $key => $table)
                                                        <option value="{{ $table }}">{{ $table }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="import[column][row_{{$index}}]" id="">
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
                            @csrf
                            <button class="btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        function tableChanged(self, e) {
            const $self = $(self);

            $.post("{{ url('api/get-columns') }}", {
                    table: $self.val()
                },
                function(data, textStatus, jqXHR) {
                    $columns = $self.parent().siblings(":last").children('select');
                    $columns.children().not(':first').remove();
                    $.each(data, function(i, v) {
                        $columns.append(
                            `<option value="${v.Field}">${v.Field}${v.Null != 'NO' ? ' -- This field is required!' : ''}</option>`
                            );
                    });
                }
            );
        }
    </script>
    @livewireScripts
</body>

</html>
