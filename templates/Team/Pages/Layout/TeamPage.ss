<% require themedCSS('components/_team') %>
<% include Banner %>
<div class="teammodul container-fluid mb-5">
    <% loop $TeamCategories %>
        <div class="row">
            <% if $TeamMembers %>
                <div class="col-md-12 my-4 typography teammodul__kategorie">
                    <h4 class="border-bottom pb-2">$Title</h4>
                </div>
            <% end_if %>

            <% loop $TeamMembers %>
                <div class="col-md-4 typography teammember_detail mb-5">
                    <div>
                        <img class="img-fluid mb-4 img-shadow" src="$Image.FocusFill(500,500).URL"/>
                    </div>

                    <div class="team__name mt-2 mb-3">
                        <h1 class="small mb-3">$Title</h1>
                        <h2 class="small">$Position</h2>
                    </div>

                    <% if $Phone %>
                        <span>T:</span><span class="ml-3">$Phone</span>
                        <hr/>
                    <% end_if %>
                    <% if $Mobile %>
                        <span>H:</span><span class="ml-3">$Mobile</span>
                        <hr/>
                    <% end_if %>
                    <% if $Mail %>
                        <span>M:</span><span class="ml-3"><a href="mailto:$Mail">$Mail</a></span>
                        <hr/>
                    <% end_if %>
                    <% if $Fax %>
                        <span>F:</span><span class="ml-3">$Fax</span>
                        <hr/>
                    <% end_if %>

                </div>
            <% end_loop %>
        </div>
    <% end_loop %>
</div>

$ElementalArea