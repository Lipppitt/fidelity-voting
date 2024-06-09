<div>
    <table>
        <thead>
            <tr>
                <th>Option</th>
                <th>Total Votes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pollVotes as $vote)
                <tr>
                    <td>{{$vote['label']}}</td>
                    <td>{{$vote['count']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

