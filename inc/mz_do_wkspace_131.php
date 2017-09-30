<?php

print <<< endprint

<div style="text-align:right;position:relative;top:-8px;right:-18px;z-index:inherit">
<input type="button" style="height:30px; width:30px;background-color:#ffffff;font-size:16px;text-align:center; solid;font-weight:bold;color:#880000;" name="Cancel" value="X" onclick="close_wkspace_00();">
</div>
 
<div style="height:500px;position:relative;top:-40px">
<h3>Membership Renewal Processing</h3>
<hr>
Please specify the criteria for selecting members to generate renewal notice for.
<br>
<br>
<table width=90% style="border-bottom:1px;border-right:1px;">
<tr><td width=5%><input type="radio" name="x_renewals" value="1" checked="checked"/></td>
<td>All Members.</td>
</tr>
<tr><td colspan=4><hr></td></tr>
<tr rowspan=2>
<td width=5%><input type="radio" name="x_renewals" value="2"  size="2" /></td>
<td width=60%>Number of days from today to Membership expiry date (inclusive):</td>
<td>From: </td>
<td><input name="x_days_to_renewal_from" value=35 size=3 maxlength=3>
 To: <input name="x_days_to_renewal_to" value=50 size=3 maxlength=3></td>
</tr>
<tr><td colspan=4><hr></td></tr>
<tr>
<td width=5%><input type="radio" name="x_renewals" value="3" size="2" /></td>
<td>Membership expiry date: (inclusive):</td>
<td>From:</td>
<td><input type="text" name="x_expiry_day_from" width=2 size=2>
 / <input type="text" name="x_expiry_month_from" width=2 size=2>
 / <input type="text" name="x_expiry_year_from" width=4 size=4><span style="color:#880000;font-size:0.8em;">(dd / mm / yyyy)</span></td>
</tr>
<tr>
<td></td><td></td>
<td>To:</td>
<td><input type="text" name="x_expiry_day_to" width=2 size=2>
 / <input type="text" name="x_expiry_month_from" width=2 size=2>
 / <input type="text" name="x_expiry_year_from" width=4 size=4><span style="color:#880000;font-size:0.8em;">(dd / mm / yyyy)</span></td>
</tr>
<tr><td colspan=4><hr style="height:3px;color:#888888;background:#666666;"></td></tr>
<tr>
<td width=5%><input type="checkbox" name="x_renewals_name" value="1" size="2" /></td>
<td>Membership name range: (inclusive):</td>
<td>From:</td>
<td><input type="text" name="x_expiry_name_from" width=15 size=15></td>
 </tr>
<tr>
<td></td><td></td>
<td>To:</td>
<td><input type="text" name="x_expiry_name_to_to" width=15 size=15></td>
</tr>
<tr><td colspan=4><hr style="height:3px;color:#888888;background:#666666;"></td></tr>
<tr>
<td width=5%><input type="checkbox" name="x_renewals_cat" value="1" size="2" /></td>
<td>Membership category range: (inclusive):</td>
<td>From:</td>
<td><input type="text" name="x_expiry_category_from" width=3 size=3></td>
 </tr>
<tr>
<td></td><td></td>
<td>To:</td>
<td><input type="text" name="x_expiry_category_to_to" width=3 size=3></td>
</tr>
<tr><td></td><td></td><td></td>
 <td></td>
</tr>
</table>
<br>
<br>

</div>

endprint
?>
