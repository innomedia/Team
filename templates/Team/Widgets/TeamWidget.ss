<% require themedCSS('components/_team') %>
<div class="team pb-2">
    <% with $TeamMember %>
      <div class="typography teammember_detail mb-3">
        <img class="img-fluid mb-4 img-shadow" src="$Image.FocusFill(500,500).URL" />
        <div class="team__name mt-2 mb-3">
            <h5 class="card-title mb-0">Von $Title</h5>
            <p class="mb-3">$Position</p>
            <div>
              <% if $Phone %>
                  <button type="button" class="btn btn-small-square mr-2" data-toggle="tooltip" data-placement="bottom" title="$Phone">
                      <i class="fal fa-phone"></i>
                  </button>
              <% end_if %>

              <% if $Mobile %>
                  <button type="button" class="btn btn-small-square mr-2" data-toggle="tooltip" data-placement="bottom" title="$Mobile">
                      <i class="fal fa-mobile"></i>
                  </button>
              <% end_if %>

              <% if $Fax %>
                  <button type="button" class="btn btn-small-square mr-2" data-toggle="tooltip" data-placement="bottom" title="$Fax">
                      <i class="fal fa-fax"></i>
                  </button>
              <% end_if %>

              <% if $Mail %>
                  <button type="button" class="btn btn-small-square mr-2" data-toggle="tooltip" data-placement="bottom" title="$Mail">
                      <i class="fal fa-envelope"></i>
                  </button>
              <% end_if %>

      </div>
    </div>
    </div>
  <% end_with %>
</div>
