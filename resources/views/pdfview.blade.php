<!DOCTYPE html>
<html>
    <head>
    <title>Simple Application to view the pdf</title>
        <style type="text/css">
        table td, table th{
        border:1px solid black;
        }
        </style>
    </head>
    <body>

        <div class="container">
            @if (!empty($error))
                <p style="color: #b00020; font-weight: 600;">{{ $error }}</p>
            @endif

            <a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a>
            <table>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            @forelse ($items as $key => $item)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $item->name }}</td>  
                    <td>{{ $item->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No user data found yet.</td>
                </tr>
            @endforelse
            </table>
        </div>
    </body>
</html>
