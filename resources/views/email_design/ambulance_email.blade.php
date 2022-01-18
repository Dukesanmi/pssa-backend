
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" >
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="20" cellspacing="0" width="800" >
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%">
                            <tr>
<td align="center" valign="top" style="background: #008751; font-size: 20px; font-weight: 600; font-family: Montserrat, sans-serif;
    color: #fff;">My Emergency App "NPF Rescue me!" reports:</td>
</tr>

<tr>
<td align="center" valign="top" style="font-size: 25px; color: #ff0000; font-family: Montserrat, sans-serif; ">!!! AMBULANCE REQUEST ALARM !!!</td>
</tr>

<tr>
<td align="center" valign="top" style="font-family: Montserrat, sans-serif;">AFTER RECEIVING CALL ME BACK</td>
</tr>

<tr>
<td align="center" valign="top" style="font-family: Montserrat, sans-serif;">Info on my helper network:</td>
</tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" >
                            <tr>
    <th align="left" style="font-size: 20px; font-family: Montserrat, sans-serif;">My personal emergency data:</th>
  </tr>
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Name:</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{@$getUserInfo->name}}</td>
  </tr>
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Where? Emergency location:</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;"> {{@$getUserInfo->address}}</td>
  </tr>
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Nature of incedent:</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['nature_of_incedent']}}</td>
  </tr>
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">How many people are in need</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['number_of_person']}}</td>
  </tr>
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Callback number</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{@$getUserInfo->mobile_number}}</td>
  </tr>
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Email</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;"><a href="#">{{@$getUserInfo->email}}</a></td>
  </tr>
  
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Hospital Name</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['hospital_name']}}</td>
  </tr>
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Location</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['location']}}</td>
  </tr>
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Name</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['name']}}</td>
  </tr>
  <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Mobile Number</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['mobile_number']}}</td>
  </tr>
    <tr>
    <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Medication</td>
    <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['medication'] == '1' ? 'chat' : 'Call'}}</td>
  </tr>
                        </table>
                    </td>
                </tr>
              
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" >
                            <tr>
                                <td align="center" valign="top" style="font-family: Montserrat, sans-serif; background: #008751; color:#fff;">
                                    © 2019 NPF Rescue me All Rights Reserved
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
