<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="invoiceModalLabel">Tax Invoice</h5>
                <h2 id="date"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td colspan="5" rowspan="2">
                            <h4 class="agentName"> </h4>
                            <!--<p> Company's GSTIN/UIN:</p>-->
                            <b>GST Number:</b>
                            <p id="gst_modal"></p>
                            <p><b>Address:</b></p>
                            <p class="address"></p>
                        </td>
                        <td>
                            Invoice No.
                            <p id="invoice"></p>
                        </td>
                        <td>
                            Date
                            <p id="date_modal"></p>
                            <p id="email"></p>
                        </td>

                    </tr>
                    <tr>
                        <!--<td> Delivery Note</td>-->
                        <td>
                            Mode/Terms of Payment
                        </td>
                        <td id="payment_type_modal"></td>
                    </tr>

                    <tr>
                        <td colspan="5" rowspan="2">
                            <div>
                                <img id="imageLogo" src="<?= base_url('Finexpertlogo.png') ?>"
                                    style="height: 50px; width: 200px" alt="Finexperts Logo" />

                            </div><br>
                            6-3-661/B/2, Plot No 78, 2nd, SANGEETH NAGAR <br>
                            SOMAJIGUDA,HADRABAD <br>
                            GSTIN/UIN : 36AAGFF3638R1ZT <br>
                            <!--PAN/IT No  :                 <br>-->
                            State Name : Telangana, Code:36
                        </td>

                        <td colspan="3"> Terms of Delivery </td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td style="text-align: center;"> Sl No.</td>
                        <td style="text-align: center;" colspan="4"> Particulars</td>
                        <td style="text-align: center;"> HSN/SAC</td>
                        <td style="text-align: center;" id="amount"> Amount </td>
                    </tr>
                    <tr>
                        <td style="border-bottom:none;border-top:none;">1 </td>
                        <td colspan="4">Commission</td>
                        <td style="border-bottom:none;border-top:none;"> </td>
                        <td id="paymentamount"> </td>
                    </tr>
                    <tr class="cgstamount">
                        <td style="border-bottom:none;border-top:none;">2</td>
                        <td colspan="4">CGST</td>
                        <td style="border-bottom:none;border-top:none;"> </td>
                        <td class="cgst_modal"> </td>
                    </tr>
                    <tr class="sgstamount">
                        <td style="border-bottom:none;border-top:none;">3</td>
                        <td colspan="4">SGST</td>
                        <td style="border-bottom:none;border-top:none;"> </td>
                        <td class="sgst_modal"> </td>
                    </tr>
                    <tr class="igstamount">
                        <td style="border-bottom:none;border-top:none;">3</td>
                        <td colspan="4">IGST</td>
                        <td style="border-bottom:none;border-top:none;"> </td>
                        <td class="igst_modal"> </td>
                    </tr>
                    <!--<tr>-->
                    <!--    <td style="border-bottom:none;border-top:none;">4</td>-->
                    <!--    <td  colspan="4">Already Paid</td>-->
                    <!--    <td style="border-bottom:none;border-top:none;"> </td>-->
                    <!--    <td id="paymentdeduction">  </td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--    <td style="border-bottom:none;border-top:none;">5</td>-->
                    <!--    <td  colspan="4">EMI</td>-->
                    <!--    <td style="border-bottom:none;border-top:none;"> </td>-->
                    <!--    <td id="monthlyEmi">  </td>-->
                    <!--</tr>-->
                    <tr>
                        <td style="border-bottom:none;border-top:none;"> </td>
                        <td colspan="4" style="text-align: right;">Total</td>
                        <td> </td>
                        <td id="total_amount"> </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            Amount Chargeable (in words)
                            <b>
                                <p id="word">
                            </b> </p>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2"> HSN/SAC</td>
                        <td rowspan="2"> Taxable <br> Value</td>
                        <td colspan="2"> Central Tax</td>
                        <td colspan="2"> State Tax</td>
                        <td rowspan="2"> Total <br>
                            Tax Amount </td>
                    </tr>
                    <tr>
                        <td>Rate</td>
                        <td>Amount</td>
                        <td>Rate</td>
                        <td>Amount</td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td id=""> </td>
                        <td id="cgstrate"></td>
                        <td class="cgst_modal"></td>
                        <td id="sgstrate"></td>
                        <td class="sgst_modal"></td>
                        <td class="igst_modal" id="igst_modal"></td>
                    </tr>
                    <tr>
                        <td style="height: 100px;" colspan="7">

                            Tax Amount (in word) : <p id="inword"></p>
                            <br>
                            <br>
                            <br>
                            Company's GSTIN/UIN :

                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" colspan="3" style="text-align: left;">
                            Customer's Seal and Signature
                        </td>
                        <td rowspan="2" colspan="4" style="text-align: right;">
                            for <h6 class="agentName"></h6>
                            <br> <br>
                            Authorised Signatory
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="downloadPdfBtn">Download</button>
            </div>
        </div>
    </div>
</div>