<p class="form-row form-row-last form-group validate-required" data-priority="20">
    <label for="email" class="control-label">
        SELECT STATE&nbsp;<abbr class="required" title="required">*</abbr>
    </label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text form-control input-lg" name="state" id="email" placeholder=""
            value="<?= $state; ?>" autocomplete="family-name">
    </span>
</p>
<p class="form-row form-row-last form-group validate-required" data-priority="20">
    <label>Select Country&nbsp;<span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <select class="form-control" name="country" class='countryList' id="countryList">
            <option>Choose Country..</option>
            <?php
            $fetchCountries = mysqli_query($con, "SELECT * FROM awt_countries");
            if ($fetchCountries) {
                while ($row = mysqli_fetch_assoc($fetchCountries)) {
                    $selected = ($row['id'] == $country_id) ? 'selected' : '';
                    ?>
                    <option value="<?= $row['id'] ?>" <?= $selected ?>>
                        <?= $row['name'] ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select>
    </span>
</p>