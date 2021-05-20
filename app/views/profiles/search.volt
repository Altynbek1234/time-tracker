{{ content() }}

<div class="row mb-4">
    <div class="col-6">
       {{ link_to("profiles/index", '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', "class": "btn btn-outline-primary") }}
    </div>
    <div class="col-6 text-right">
        {{ link_to("profiles/create", '<span class="oi oi-plus" title="plus" aria-hidden="true"></span> Create Profile', "class": "btn btn-primary") }}
    </div>
</div>


<div class="table-responsive">        
{% for profile in page.items %}

{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Active?</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
{% endif %}
        <tr>
            <td>{{ profile.id }}</td>
            <td>{{ profile.name }}</td>
            <td>{{ profile.active == 'Y' ? 'Yes' : 'No' }}</td>
            <td width="12%">{{ link_to("profiles/edit/" ~ profile.id, '<span class="oi oi-pencil" title="pencil" aria-hidden="true"></span> Edit', "class": "btn btn-light btn-sm") }}</td>
            <td width="12%">{{ link_to("profiles/delete/" ~ profile.id, '<span class="oi oi-x" title="X" aria-hidden="true"></span> Delete', "class": "btn btn-light btn-sm") }}</td>
        </tr>
{% if loop.last %}
    </tbody>
    <tfoot>
        <tr>
            <td colspan="10" class="text-right"">
                   <ul class="pagination mb-0">
                    <li class="page-item">
                        {{ link_to("profiles/search", '<span class="oi oi-media-skip-backward" title="skip backward" aria-hidden="true"></span> First', "class": "page-link") }}
                    </li>
                    <li class="page-item">
                        {{ link_to("profiles/search?page=" ~ page.before, '<span class="oi oi-media-step-backward" title="step backward" aria-hidden="true"></span> Previous', "class": "page-link") }}
                    </li>
                    <li class="page-item disabled">
                        {{ link_to("#", page.current ~ "/" ~ page.total_pages, "class":"page-link") }}
                    </li>
                    <li class="page-item">
                        {{ link_to("profiles/search?page=" ~ page.next, '<span class="oi oi-media-step-forward" title="step forward" aria-hidden="true"></span> Next', "class": "page-link") }}
                    </li>
                    <li class="page-item">
                        {{ link_to("profiles/search?page=" ~ page.last, '<span class="oi oi-media-skip-forward" title="skip forward" aria-hidden="true"></span> Last', "class": "page-link") }}
                    </li>
                </ul>
            </td>
        </tr>
    </tfoot>
</table>
{% endif %}
{% else %}
    No profiles are recorded
{% endfor %}
</div>
