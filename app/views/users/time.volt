<div class=container>
<ul class="pager">
        <li class="previous pull-left">
            {{ link_to("users", "Go Back", "class": "btn btn-outline-info") }}
        </li>
    </ul>
<select id="select-month" selected="selected">
        {% for key, month in months %}
            <option value="{{ key }}">{{month}}</option>
        {% endfor %}
</select>
<select id="select-year">
        {% for key, year in years %}
            <option value="{{ key }}">{{year}}</option>
        {% endfor %}
</select>

<h1>List of times by user</h2>

<th id="test"></th>
<table>
  <tr>
    <th>Start time</th>
    <th>End time</th>
    <th>Date</th>
    <th>Total time</th>
  </tr>


  {% for time in user.times %}
  <tr>
      <td>{{time.started_time}} </td>
      <td>{{time.stopped_time}}</td>
      <td>{{time.date}}</td>

        <td width="7%">
          {{ link_to("users/update/" ~ time.id, "Edit") }}
        </td>
  </tr>
    {% endfor %}
 </table>
{{ content() }}
</div>

<script>
$( document ).ready(function() {
    $('#select-month').val('{{getMonth}}').attr('selected','selected');
    $('#select-year').val('{{getYear}}').attr('selected','selected');
});
    $('#select-month').change(function(){
        var month = $(this).val();
        console.log(month);
        var year = $('#select-year').val();
          location.assign('/time/index/{{ userId }}?month='+month+ '&year='+year);
    });
    $('#select-year').change(function(){
            var month = $('#select-month').val();
            var year = $(this).val();
              location.assign('/time/index/{{ userId }}?month='+month + '&year='+year);
        });
</script>