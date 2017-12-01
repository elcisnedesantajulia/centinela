
<!--div class="card bg-light my-2">
    <div class="card-body py-1"-->
<nav aria-label="Paginator">
  <ul class="pagination">

{% if paginator.first is defined %}
<li class="page-item"><a class="page-link" href="{{ url(index) }}">1</a></li>
{% endif %}

{% if paginator.long_back is defined %}
<li class="page-item"><a class="page-link" href="{{ url(index)~'?page='~paginator.long_back }}">
    {{ tags.icon('media-skip-backward') }}</a></li>
{% endif %}

{% if paginator.short_back is defined %}
<li class="page-item"><a class="page-link" href="{{ url(index)~'?page='~paginator.short_back }}">
    {{ tags.icon('media-step-backward') }}</a></li>
{% endif %}

{% for elemento in paginator.before %}
<li class="page-item"><a class="page-link" href="{{ url(index)~'?page='~elemento }}">
    {{ elemento }}</a></li>
{% endfor %}

<li class="page-item active">
  <a class="page-link" href="#">
    {{ paginator.current}} de {{ paginator.total_pages }} paginas de 
        {{paginator.total_items}} resultados
  </a>
</li>

{% for elemento in paginator.next %}
<li class="page-item"><a class="page-link" href="{{ url(index)~'?page='~elemento }}">
    {{ elemento }}</a></li>
{% endfor %}

{% if paginator.short_front is defined %}
<li class="page-item"><a class="page-link" href="{{ url(index)~'?page='~paginator.short_front }}">
    {{ tags.icon('media-step-forward') }}</a></li>
{% endif %}

{% if paginator.long_front is defined %}
<li class="page-item"><a class="page-link" href="{{ url(index)~'?page='~paginator.long_front }}">
    {{ tags.icon('media-skip-forward') }}</a></li>
{% endif %}

{% if paginator.last is defined %}
<li class="page-item"><a class="page-link" href="{{ url(index)~'?page='~paginator.last }}">{{ paginator.last }}</a></li>
{% endif %}

  </ul>
</nav>
<!--/div>
</div-->

