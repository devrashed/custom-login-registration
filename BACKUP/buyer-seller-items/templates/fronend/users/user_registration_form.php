<?php if ( is_user_logged_in() ) { 
    echo '<h6>You have already login</h6>';
 } else { ?>
    <div class="buyer_seller_reg_form">
    	 <div class="menus_bs">
          <h4>Create your account</h4>
          <!-- <h4><a href="">Login</a></h4>    -->
         </div>
        <form method="POST" name="user_registeration" enctype="multipart/form-data">
            <label>Username*</label>  
            <input type="text" name="username" placeholder="Enter Your Username" id="bs_username" required />
            <br/>
            <label>Email address*</label>
            <input type="text" name="useremail" id="bs_email" placeholder="Enter Your Email" required />
            <br/>
            <label>Password*</label>
            <input type="password" name="password" id="bs_password" placeholder="Enter Your password" required /> 
            <input  type="hidden" pattern="(19[0-9][0-9]|20[0-9][0-9])-(1[0-2]|0[1-9])-(3[01]|[21][0-9]|0[1-9])" name="dob" placeholder="Enter Date of Birth" id="bs_dob" />
            <br>
            <label>City/Town*</label>
            <select name="bs_address" id="bs_address" required style="background: #fff;border-radius: 0;border-style: solid;border-width: 0.1rem;box-shadow: none;display: block;font-size: 1.6rem;letter-spacing: -0.015em;margin: 0;max-width: 100%;padding: 1.5rem 1.8rem;width: 100%;">
                <option value="Bath">Bath</option>
                <option value="Birmingham">Birmingham</option>
                <option value="Bradford">Bradford</option>
                <option value="Brighton & Hove">Brighton & Hove</option>
                <option value="Bristol">Bristol</option>
                <option value="Cambridge">Cambridge</option>
                <option value="Canterbury">Canterbury</option>
                <option value="Carlisle">Carlisle</option>
                <option value="Chelmsford">Chelmsford</option>
                <option value="Chester">Chester</option>
                <option value="Chichester">Chichester</option>
                <option value="Coventry">Coventry</option>
                <option value="Derby">Derby</option>
                <option value="Durham">Durham</option>
                <option value="Ely">Ely</option>
                <option value="Exeter">Exeter</option>
                <option value="Gloucester">Gloucester</option>
                <option value="Hereford">Hereford</option>
                <option value="Kingston-upon-Hull">Kingston-upon-Hull</option>
                <option value="Lancaster">Lancaster</option>
                <option value="Leeds">Leeds</option>
                <option value="Leicester">Leicester</option>
                <option value="Lichfield">Lichfield</option>
                <option value="Lincoln">Lincoln</option>
                <option value="Liverpool">Liverpool</option>
                <option value="London">London</option>
                <option value="Manchester">Manchester</option>
                <option value="Newcastle-upon-Tyne">Newcastle-upon-Tyne</option>
                <option value="Norwich">Norwich</option>
                <option value="Nottingham">Nottingham</option>
                <option value="Oxford">Oxford</option>
                <option value="Peterborough">Peterborough</option>
                <option value="Plymouth">Plymouth</option>
                <option value="Portsmouth">Portsmouth</option>
                <option value="Preston">Preston</option>
                <option value="Ripon">Ripon</option>
                <option value="Salford">Salford</option>
                <option value="Salisbury">Salisbury</option>
                <option value="Sheffield">Sheffield</option>
                <option value="Southampton">Southampton</option>
                <option value="St Albans">St Albans</option>
                <option value="Stoke-on-Trent">Stoke-on-Trent</option>
                <option value="Sunderland">Sunderland</option>
                <option value="Truro">Truro</option>
                <option value="Wakefield">Wakefield</option>
                <option value="Wells">Wells</option>
                <option value="Westminster">Westminster</option>
                <option value="Winchester">Winchester</option>
                <option value="Wolverhampton">Wolverhampton</option>
                <option value="Worcester">Worcester</option>
                <option value="York">York</option>
            </select>
            <br>
            <label>Upload Profile Photo</label>
            <input type="file" name="file" id="bs_userprofile">
            <input type="button" id="bs_registeration" value="SignUp" />
        </form>
        <span id="bs_error_message"></span>
    </div>
<?php } ?>