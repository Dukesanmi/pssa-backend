
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" >
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="20" cellspacing="0" width="800" >
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" valign="top" style="background: #008751; font-size: 20px; font-weight: 600; font-family: Montserrat, sans-serif;
    color: #fff;">My Emergency App "Pssa Alert" reports:</td>
                            </tr>

                            <tr>
                                <td align="center" valign="top" style="font-size: 25px; color: #ff0000; font-family: Montserrat, sans-serif; ">!!! EMERGENCY ALERT ALARM !!!</td>
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
                                <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Where Emergency location:</td>
                                <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;"> <a href="http://www.google.com/maps/place/{{$inputs['latitude']}},{{$inputs['longitude']}}">{{$inputs['formatted_address']}}</a></td>
                            </tr>
                            <tr>
                                <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">What has happened:</td>
                                <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['types_of_problem']}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">How many people are affected</td>
                                <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['person_count']}}</td>
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
                                <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Network Strength</td>
                                <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['network_strength']}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Network Provider</td>
                                <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['network_provider']}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Battery level</td>
                                <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{$inputs['battery_label']}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" >
                            <tr>
                                <th align="left" style="font-size: 20px; font-family: Montserrat, sans-serif;">Shared media:</th>
                            </tr>
                            <tr>
                                <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Image:</td>
                                <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">{{@$imagesUrl}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; font-size: 18px; font-weight: 600; font-family: Montserrat, sans-serif;">Audio:</td>
                                <td style="width: 50%; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;">  <audio controls>

                                        <source src="{{$inputs['recording']}}" type='audio/3gpp'>

                                        Your browser does not support the audio tag.
                                    </audio></td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" >
                            <tr>
                                <td align="center" valign="top" style="font-family: Montserrat, sans-serif; background: #008751; color:#fff;">
                                    © 2019 Pssa Alert All Rights Reserved
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
