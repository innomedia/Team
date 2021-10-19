<div class="container pb-100">
    <div class="row pt-40">
        <% loop TeamMember %>
            <div class="col-md-4 typography mb-40">
                <img class="img-fluid mb-40 img-shadow" src="$Image.FocusFill(500,500).URL" />
                <h4>$Position</h4>
                <h3>$Title</h3> <hr />
                <% if $Phone %>
                    <h4><strong>T: </strong>$Phone</h4><hr />
                <% end_if %>
                <% if $Mobile %>
                    <h4><strong>F: </strong>$Mobile</h4><hr />
                <% end_if %>
                <% if $Mail %>
                    <h4><strong>M: </strong>$Mail</h4>
                <% end_if %>
            </div>
        <% end_loop %>
    </div>
</div>
