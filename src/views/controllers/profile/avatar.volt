

<div class="text-center">

    <h3 class="themed-color-default">Hola, {% if details != false %}{{ details.firstname }} {{ details.lastname }}{% endif %}.</h3>


    <div class="widget widget-full">
        <div class="widget-body">

            {{ image(avatar ~ '?dummy=' ~ date("y-m-d_h_i_s") ,"class":"img-circle img-thumbnail widget-img") }} <br>

        </div>
    </div>

</div>

