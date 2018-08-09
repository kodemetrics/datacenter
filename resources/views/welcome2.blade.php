@extends('layouts.odk')

@section('content')

<div class="tree">
        <ul>
            <li>
                <a href="#" class="incoming33kv-feeder">{{$data2['Feeder_Name_33kV']}}</a>
                <ul>
                    <li>
                       <ul><a href="#" class="cable-feeder"></a>
                        <ul>
                            <li><a class="flat-icon"></a>
                               <ul>
                                 <li><a class="in">{{$data2['Tr1_AMP_15MVA']}} <br> </a>
                                 <ul>
                                      <li><a class="rm"></a>
                                        <ul>
                                          <li><a class="value">RM 1A <br>{{$data2['AMP_for_RM1A']}}</a></li>
                                        </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                            <ul>
                                              <li><a class="value">RM 2A <br>{{$data2['AMP_for_RM2A']}}</a></li>
                                            </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                            <ul>
                                              <li><a class="value">RM 3A <br>{{$data2['AMP_for_RM3A']}}</a></li>
                                            </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                            <ul>
                                              <li><a class="value">RM 4A <br>{{$data2['AMP_for_RM4A']}}</a></li>
                                            </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                            <ul>
                                              <li><a class="value">RM 5A <br>{{$data2['AMP_for_RM5A']}}</a></li>
                                            </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                        <ul>
                                           <li><a class="value">RM 6A <br>{{$data2['AMP_for_RM6A']}}</a></li>
                                        </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                        <ul>
                                          <li><a class="value">RM 7A <br>{{$data2['AMP_for_RM7A']}}</a></li>
                                        </ul>
                                      </li>
                                      <li><a class="rm"></a>
                                        <ul>
                                          <li><a class="value">RM 8A <br>{{$data2['AMP_for_RM8A']}}</a></li>
                                        </ul>
                                      </li>                                    
                                    </ul>
                                 </li>
                               </ul>
                            </li>
                            <li><a class="flat-icon"></a></li>
                            <li><a class="flat-icon"></a>
                               
                               <ul>
                                 <li><a class="in">{{$data2['Tr3_AMP_15MVA']}} <br> </a>
                                    <ul>
                                      <li><a class="rm"></a>
                                        <ul>
                                          <li><a class="value">RM 1B <br>{{$data2['AMP_for_RM1B']}}</a></li>
                                        </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                            <ul>
                                              <li><a class="value">RM 2B <br>{{$data2['AMP_for_RM2B']}}</a></li>
                                            </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                            <ul>
                                              <li><a class="value">RM 3B <br>{{$data2['AMP_for_RM3B']}}</a></li>
                                            </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                            <ul>
                                              <li><a class="value">RM 4B <br>{{$data2['AMP_for_RM4B']}}</a></li>
                                            </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                            <ul>
                                              <li><a class="value">RM 5B <br>{{$data2['AMP_for_RM5B']}}</a></li>
                                            </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                        <ul>
                                           <li><a class="value">RM 6B <br>{{$data2['AMP_for_RM6B']}}</a></li>
                                        </ul> 
                                      </li>
                                      <li><a class="rm"></a>
                                        <ul>
                                          <li><a class="value">RM 7B <br>{{$data2['AMP_for_RM7B']}}</a></li>
                                        </ul>
                                      </li>
                                      <li><a class="rm"></a>
                                        <ul>
                                          <li><a class="value">RM 8B <br>{{$data2['AMP_for_RM8B']}}</a></li>
                                        </ul>
                                      </li>                                    
                                    </ul>
                                 
                                 </li>
                               </ul>
                            </li>
                            <!--<li><a>Transfomer 4</a></li>-->
                        </ul>
                    </li> 

                </ul>
            </li>
        </ul>
    </div>
     
               <ol>
                    <li>Injection name: {{$data[0]['col2']}}</li>
                    <li>Start_time:{{$data2['Data_Capture_Starting_Time']}} </li>
                    <li>Endtime: {{$data2['End_Time']}}</li>
                    <li>Region:{{$data2['Regions']}}</li>
                    <li>Hour read:{{$data2['Hour_Read']}}</li>
                    <li>AMP_for_RM1B:{{$data2['AMP_for_RM1B']}}</li>
                    <li>AMP_for_RM2A:{{$data2['AMP_for_RM2A']}}</li>
                    <li>AMP_for_RM2B:{{$data2['AMP_for_RM2B']}}</li>
                    <li>AMP_for_RM3A:{{$data2['AMP_for_RM3A']}}</li>
                    <li>AMP_for_RM4A:{{$data2['AMP_for_RM4A']}}</li>
                    <li>AMP_for_RM4B:{{$data2['AMP_for_RM4B']}}</li>
                    <li>AMP_for_RM5A:{{$data2['AMP_for_RM5A']}}</li>
                    <li>AMP_for_RM5B:{{$data2['AMP_for_RM5B']}}</li>
                    <li>AMP_for_RM6A:{{$data2['AMP_for_RM6A']}}</li>
                    <li>AMP_for_RM6B:{{$data2['AMP_for_RM6B']}}</li>
                    <li>AMP_for_RM7A:{{$data2['AMP_for_RM7A']}}</li>
                    <li>AMP_for_RM7B:{{$data2['AMP_for_RM7B']}}</li>
                    <li>AMP_for_RM8A:{{$data2['AMP_for_RM8A']}}</li>
                    <li>AMP_for_RM8B:{{$data2['AMP_for_RM8B']}}</li>
                    <li>Staff_Number:{{$data2['Staff_Number']}}</li>
                    <li>Tr1_kV_15MVA:{{$data2['Tr1_kV_15MVA']}}</li>
                    <li>Tr3_kV_15MVA:{{$data2['Tr3_kV_15MVA']}}</li>
                    <li>Tr1_AMP_15MVA:{{$data2['Tr1_AMP_15MVA']}}</li>
                    <li>Tr1_TAP_15MVA:{{$data2['Tr1_TAP_15MVA']}}</li>
                    <li>Tr3_AMP_15MVA:{{$data2['Tr3_AMP_15MVA']}}</li>
                    <li>Tr3_TAP_15MVA:{{$data2['Tr3_TAP_15MVA']}}</li>
                    <li>Feeder_Name_33kV:{{$data2['Feeder_Name_33kV']}}</li>
                    <li>Busbar_1_kV_15MVA:{{$data2['Busbar_1_kV_15MVA']}}</li>
                    <li>Busbar_2_kV_15MVA:{{$data2['Busbar_2_kV_15MVA']}}</li>
                    <li>DSO_Names_on_Duty:{{$data2['DSO_Names_on_Duty']}}</li>
                    <li>DSO_Phone_Numbers:{{$data2['DSO_Phone_Numbers']}}</li>
                    <li>{{$data2['*meta-is-complete*']}}</li>
                    <li>{{$data2['Incomer_1_Load_11kv']}}</li>
                    <li>{{$data2['Incomer_3_Load_11kV']}}</li>
                    <li>{{$data2['Injection_Substations']}}</li>
                    <li>{{$data2['*meta-submission-date*']}}</li>
                    <li>{{$data2['Data_Capture_Starting_Time']}}</li>
                    <li>{{$data2['*meta-date-marked-as-complete*']}}</li>
                    <li>{{$data2['Tripping_Unit_Panel_Charger_1A']}}</li>
                    <li>{{$data2['Tripping_Unit_Panel_Charger_1V']}}</li>
                    <li>{{$data2['Cable_1_Feeder_to_Station_Load_15MVA']}}</li>
                   
             </ol>
       </table>
  

    @endsection