<%-- require themedCSS('components/_team.css') --%>
<%-- require themedCSS('components/_blog.css') --%>
<div class="typography">
  <div class="bg_blue bg_ansprechpartner shadow mb-30 pt-50 pl-20 pr-20 border-radius-bottom-right_30 typography">
    <span class="h2"><%t Team.YOURCONTACTPERSON "Ihr Ansprechpartner" %></span>
  </div>
  <% with TeamMember %>
    <span class="h2">$Title</span>
    <span class="date">$Position</span>
    <% if $Phone %>
      <div>
          <span class="font_blue font_bold personDataDecore">T</span><span>$Phone</span>
      </div>
    <% end_if %>
    <% if $Mail %>
      <div>
        <span class="font_blue font_bold personDataDecore">M</span><span>$Mail</span>
      </div>
    <% end_if %>
  <% end_with %>
</div>
