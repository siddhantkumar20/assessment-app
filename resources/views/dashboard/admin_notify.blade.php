
<h3>Notifications:</h3>
<table>
    <tbody>
        <tr>
            <td>
                @foreach($admin->notifications as $notification)
                    <p>{{ $notification->data->user_name }} has registered.</p>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>
