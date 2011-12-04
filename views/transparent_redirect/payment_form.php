<% @ajax        ?= false %>
<% @redirectUrl ?= '#' %>
<% @classes     ?= '' %>
<% @config      ?= @samurai.Connection.config %>

<div id="content" class="wrapper payment-form transparent-redirect">
  <h1>Checkout</h1>

  <section class="shopping-cart">
    <h2>Shopping Cart</h2>
    <table cellpadding="0" cellspacing="0">
      <thead>
        <tr><th>Qty</th><th>Item</th><th>Price</th></tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><img src="/images/nunchucks.jpg" width="40" height="40" class="left cleaner">Transparent Redirect Nunchucks</td>
          <td>$  22.00</td>
        </tr>
        <tr>
          <td></td>
          <td>Overnight Shipping (battle imminent!)</td>
          <td>$ 100.00</td>
        </tr>
        <tr class="total">
          <td></td>
          <td>Total:</td>
          <td>$ 122.00</td>
        </tr>
      </tbody>
    </table>
  </section>

  <section class="payment-info">
    <h2>Enter your payment information:</h2>
    <div class="samurai">
      <% if @transaction?.hasErrors() or @paymentMethod?.hasErrors(): %>
        <div id="error_explanation">
          <h4>This transaction could not be processed:</h4>
          <ul>
          <% if @transaction?.hasErrors(): %>
            <% for context, errors of @transaction.errors when errors.length is not 0: %>
              <% for error in errors: %><li><%- error.description() %></li><% end %>
            <% end %>
          <% end %>
          <% if @paymentMethod?.hasErrors(): %>
            <% for context, errors of @paymentMethod.errors: %>
              <% for error in errors: %><li><%- error.description() %></li><% end %>
            <% end %>
          <% end %>
          </ul>
        </div>
      <% end %>

      <form action="<%= @config.site %>/payment_methods" method="POST" class="samurai <%= @classes %>" <%= 'data-samurai-ajax' if @ajax %>>
        <fieldset>
          <input name="redirect_url" type="hidden" value="<%= @redirectUrl %>" />
          <input name="merchant_key" type="hidden" value="<%= @config.merchant_key %>" />
          <input name="sandbox" type="hidden" value="<%= @config.sandbox %>" />
          <% if @paymentMethod?.token: %><input name="payment_method_token" type="hidden" value="<%= @paymentMethod?.token %>" /><% end %>
        </fieldset>

        <fieldset>
          <div class="field-group" id="credit_card_name_group">
            <div>
              <label for="credit_card_first_name">First name</label>
              <input id="credit_card_first_name" name="credit_card[first_name]" size="30" type="text" value="<%= @paymentMethod?.firstName %>" />
            </div>
            <div>
              <label for="credit_card_last_name">Last name</label>
              <input id="credit_card_last_name" name="credit_card[last_name]" size="30" type="text" value="<%= @paymentMethod?.lastName %>" />
            </div>
          </div>

          <div class="field-group" id="credit_card_address_group">
            <div>
              <label for="credit_card_address_1">Address 1</label>
              <input class="div-6" id="credit_card_address_1" name="credit_card[address_1]" size="30" type="text" value="<%= @paymentMethod?.address1 %>" />
            </div>
            <div>
              <label for="credit_card_address_2">Address 2</label>
              <input class="div-6" id="credit_card_address_2" name="credit_card[address_2]" size="30" type="text" value="<%= @paymentMethod?.address2 %>" />
            </div>
          </div>

          <div class="field-group" id="location_group">
            <div>
              <label for="credit_card_city">City</label>
              <input id="credit_card_city" name="credit_card[city]" size="30" type="text" value="<%= @paymentMethod?.city %>" />
            </div>
            <div>
              <label for="credit_card_state">State</label>
              <input class="" id="credit_card_state" name="credit_card[state]" size="30" type="text" value="<%= @paymentMethod?.state %>" />
            </div>
            <div>
              <label for="credit_card_zip">Zip</label>
              <input class="" id="credit_card_zip" name="credit_card[zip]" size="30" type="text" value="<%= @paymentMethod?.zip %>" />
            </div>
          </div>
        </fieldset>

        <fieldset>
          <div class="field-group" id="credit_card_info_group">
            <div>
              <label for="credit_card_card_number">Card Number</label>
              <input id="credit_card_card_number" name="credit_card[card_number]" size="30" type="text" value="<%= @paymentMethod?.cardNumber %>" autocomplete="off" />
              <label data-samurai-card-previews class="show-accepted">
                <span class='visa'></span>
                <span class='mastercard'></span>
                <span class='amex'></span>
                <span class='discover'></span>
              </label>
            </div>
            <div id="samurai_card_cvv">
              <label for="credit_card_cvv">CVV</label>
              <input class="div-1" id="credit_card_cvv" name="credit_card[cvv]" size="30" type="text" value="<%= @paymentMethod?.cvv %>" autocomplete="off" />
            </div>
          </div>
          <div class="field-group" id="credit_card_expiration">
            <div>
              <label for="credit_card_expiry_month">Expires on</label>
              <select id="credit_card_expiry_month" name="credit_card[expiry_month]">
                <option value="1" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '1' %>>01</option>
                <option value="2" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '2' %>>02</option>
                <option value="3" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '3' %>>03</option>
                <option value="4" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '4' %>>04</option>
                <option value="5" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '5' %>>05</option>
                <option value="6" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '6' %>>06</option>
                <option value="7" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '7' %>>07</option>
                <option value="8" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '8' %>>08</option>
                <option value="9" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '9' %>>09</option>
                <option value="10" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '10' %>>10</option>
                <option value="11" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '11' %>>11</option>
                <option value="12" <%= 'selected' if @paymentMethod?.expiryMonth.toString() is '12' %>>12</option>
              </select>
              <select id="credit_card_expiry_year" name="credit_card[expiry_year]">
                <option value="2011" <%= 'selected' if @paymentMethod?.expiryYear.toString() is '2011' %>>2011</option>
                <option value="2012" <%= 'selected' if @paymentMethod?.expiryYear.toString() is '2012' %>>2012</option>
                <option value="2013" <%= 'selected' if @paymentMethod?.expiryYear.toString() is '2013' %>>2013</option>
                <option value="2014" <%= 'selected' if @paymentMethod?.expiryYear.toString() is '2014' %>>2014</option>
                <option value="2015" <%= 'selected' if @paymentMethod?.expiryYear.toString() is '2015' %>>2015</option>
                <option value="2016" <%= 'selected' if @paymentMethod?.expiryYear.toString() is '2016' %>>2016</option>
              </select>
            </div>
          </div>
        </fieldset>

        <button type='submit' class='button'>Submit Payment</button>
        <span class='loading' style="display: none;"></span>
        <span class='results' style="display: none;"></span>
      </form>
    </div>
  </section>

  <footer>
    <a href="/" class="back">Back to the Samurai Weapons</a>
  </footer>
</div>

