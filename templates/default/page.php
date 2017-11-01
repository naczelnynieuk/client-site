
<div class="container bootstrap snippet">
<div class="panel-body inf-content " style="margin-top: 80px; padding-top: 15px;">
    <div class="row justify-content-md-center" >
        <div class="col-md-4">
            <img alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip" src="https://bootdey.com/img/Content/user-453533-fdadfd.png" data-original-title="Usuario"> 
            <ul title="Ratings" class="list-inline ratings text-center">
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
            </ul>
        </div>
        <div class="col-md-6">
            <strong>Informacje</strong><br>
            <div class="table-responsive">
            <table class="table table-condensed table-responsive table-user-information">
                <tbody>
                    <tr>    
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-user  text-primary"></span>    
                                Nazwa użytkownika                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            <?php echo escape($user['username']); ?>     
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-cloud text-primary"></span>  
                                Email                                               
                            </strong>
                        </td>
                        <td class="text-primary">
                            <?php echo escape($user['email']); ?>  
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-eye-open text-primary"></span> 
                                Ranga                                               
                            </strong>
                        </td>
                        <td class="text-primary">
                            <?php if ($user['permission'] == 0): ?>
                            	Klient
                            <?php endif ?>
                            <?php if ($user['permission'] == 1): ?>
                            	Administrator
                            <?php endif ?>
                            <?php if ($user['permission'] == 2): ?>
                            	Koder
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>    
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-user  text-primary"></span>    
                                Skype                                               
                            </strong>
                        </td>
                        <td class="text-primary">
                            <?php echo escape($user['skype']); ?>     
                        </td>
                    </tr>
                    <tr>    
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-user  text-primary"></span>    
                                GG                                               
                            </strong>
                        </td>
                        <td class="text-primary">
                            <?php echo escape($user['gg']); ?>     
                        </td>
                    </tr>
                    <tr>    
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-user  text-primary"></span>    
                                Numer Telefonu                                               
                            </strong>
                        </td>
                        <td class="text-primary">
                            <?php echo escape($user['phone_number']); ?>
                        </td>
                    </tr>                                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>                                        
















<div class="container">
	
</div>