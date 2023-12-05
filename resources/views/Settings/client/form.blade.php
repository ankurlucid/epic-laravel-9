<style>
    label.strong {
        margin-right: 5px;
    }
</style>
<div class="row">
    <div class="col-6">

        <div class="input-group input-group-static">
            {!! Form::label('first_name', 'What is your first name *', ['class' => 'strong']) !!}
            <span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left"
                title="This is the clients first name">
                <i class="fa fa-question-circle"></i>
            </span>
            {!! Form::text('first_name', isset($client) ? $client->firstname : null, [
                'class' => 'form-control',
                'required' => 'required',
            ]) !!}
        </div>
        @error('first_name')
            <p class='text-danger inputerror'> {!! $errors->first('first_name') !!} </p>
        @enderror

        <div class="input-group input-group-static mt-4">
            {!! Form::label('last_name', 'What is your last name', ['class' => 'strong']) !!}
            <span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left"
                title="This is the clients last name">
                <i class="fa fa-question-circle"></i>
            </span>
            {!! Form::text('last_name', isset($client) ? $client->lastname : null, ['class' => 'form-control']) !!}

        </div>
        @error('last_name')
            <p class='text-danger inputerror'> {!! $errors->first('last_name') !!} </p>
        @enderror

        <div class="input-group input-group-static mt-4">
            {!! Form::label('client_status', 'What is client status *', ['class' => 'strong']) !!}
            <span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left"
                title="Here will be tooltip text">
                <i class="fa fa-question-circle"></i>
            </span>
            <?php $clientStatus = ['' => '-- Select --'] + clientStatuses(); ?>
            {!! Form::select('client_status', $clientStatus, isset($client) ? $client->account_status_backend : 'pending', [
                'class' => 'form-control',
                'required' => 'required',
            ]) !!}
        </div>
        @error('client_status')
            <p class='text-danger inputerror'> {!! $errors->first('client_status') !!} </p>
        @enderror

        <div class="input-group input-group-static mt-4">
            {!! Form::label(null, 'I Identify my gender as', ['class' => 'strong']) !!}
            <span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left"
                title="This relates to the gender of the client">
                <i class="fa fa-question-circle"></i>
            </span>

            <div class="form-check radio clip-radio radio-primary radio-inline m-b-0">
                <input type="radio" name="gender" id="male" value="Male"
                    {{ isset($client) && $client->gender == 'Male' ? 'checked' : '' }}>
                <label for="male">
                    Male
                </label>
            </div>
            <div class="form-check radio clip-radio radio-primary radio-inline m-b-0">
                <input type="radio" name="gender" id="female" value="Female"
                    {{ isset($client) && $client->gender == 'Female' ? 'checked' : '' }}>
                <label for="female">
                    Female
                </label>
            </div>
        </div>
        @error('gender')
            <p class='text-danger inputerror'> {!! $errors->first('gender') !!} </p>
        @enderror

        <div class="input-group input-group-static mt-4">
            {!! Form::label('goalHealthWellness', 'What are your goals', ['class' => 'strong']) !!}
            <span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left"
                title="Here will be tooltip text">
                <i class="fa fa-question-circle"></i>
            </span>
            {!! Form::select(
                'goalHealthWellness',
                [
                    'Health & Wellness' => 'Health & Wellness',
                    'Improved Endurance' => 'Improved Endurance',
                    'Improved Nutrition' => 'Improved Nutrition',
                    'Improved Performance' => 'Improved Performance',
                    'Increased Energy' => 'Increased Energy',
                    'Injury Recovery' => 'Injury Recovery',
                    'Lose Weight' => 'Lose Weight',
                    'Strength & Conditioning' => 'Strength & Conditioning',
                    'Tone Up' => 'Tone Up',
                ],
                isset($client) && count($client->goalHealthWellness) ? $client->goalHealthWellness : null,
                ['class' => 'form-control', 'multiple'],
            ) !!}
        </div>

        <div class="input-group input-group-static mt-4">
            {!! Form::label('day', 'When were you born', ['class' => 'strong']) !!}
            <span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left"
                title="This relates to the client date of birth">
                <i class="fa fa-question-circle"></i>
            </span>

            {!! Form::select(
                'day',
                [
                    '01' => '1',
                    '02' => '2',
                    '03' => '3',
                    '04' => '4',
                    '05' => '5',
                    '06' => '6',
                    '07' => '7',
                    '08' => '8',
                    '09' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                    '13' => '13',
                    '14' => '14',
                    '15' => '15',
                    '16' => '16',
                    '17' => '17',
                    '18' => '18',
                    '19' => '19',
                    '20' => '20',
                    '21' => '21',
                    '22' => '22',
                    '23' => '23',
                    '24' => '24',
                    '25' => '25',
                    '26' => '26',
                    '27' => '27',
                    '28' => '28',
                    '29' => '29',
                    '30' => '30',
                    '31' => '31',
                ],
                isset($client) ? $client->birthDay : null,
                ['class' => 'form-control', 'title' => 'DAY'],
            ) !!}



            <select class="form-control" title="MONTH" name="month">
                @if (isset($client))
                    {!! monthDdOptions($client->birthMonth) !!}
                @else
                    {!! monthDdOptions() !!}
                @endif
            </select>



            <select class="form-control" title="YEAR" name="year">
                @if (isset($client))
                    {!! yearDdOptions($client->birthYear) !!}
                @else
                    {!! yearDdOptions() !!}
                @endif
            </select>

        </div>


    </div>

    <div class="col-6">

        <div class="input-group input-group-static">
            <label class="strong" for="referrer">Where did you hear about EPIC?</label>
            <select id="referrer" name="referrer" class="form-control">
                <option value="">-- Select --</option>
                <option value="onlinesocial" <?php echo isset($client->parq) && $client->parq->hearUs == 'onlinesocial' ? 'selected' : ''; ?>>Online &amp; Social Media</option>
                <option value="mediapromotions" <?php echo isset($client->parq) && $client->parq->hearUs == 'mediapromotions' ? 'selected' : ''; ?>>Media &amp; Promotions</option>
                <option value="referral" <?php echo isset($client->parq) && $client->parq->hearUs == 'referral' ? 'selected' : ''; ?>>Referral</option>
                <option value="socialmedia" <?php echo isset($client->parq) && $client->parq->hearUs == 'socialmedia' ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>

        <div class="input-group input-group-static mt-4 referencewhere">
            <label class="strong">From where?</label>
            <input type="text" id="referencewhere" name="referencewhere"
                value="{{ isset($client->parq) ? $client->parq->referencewhere : '' }}" class="form-control">
        </div>

        <div class="input-group input-group-static mt-4 otherName hidden">
            <label class="strong">Source</label>
            <input type="text" id="otherName" name="otherName"
                value="{{ isset($client->parq) ? $client->parq->referrerother : '' }}" class="form-control">
        </div>

        <div class="input-group input-group-static mt-4">
            {!! Form::label('email', 'Please provide your primary email address *', ['class' => 'strong']) !!}
            <span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left"
                title="This email is the default for outgoing email correspondence and promotional materials for this client">
                <i class="fa fa-question-circle"></i>
            </span>
            {!! Form::email('email', isset($client) ? $client->email : null, ['class' => 'form-control']) !!}
        </div>
        @error('email')
            <p class='text-danger inputerror'> {!! $errors->first('email') !!} </p>
        @enderror


        <div class="input-group input-group-static mt-4">
            <div class="form-check">
                <input type="checkbox" name="login_with_email" id="login_with_email_client" value="1"
                    class="js-ifCreateLogin form-check-input"
                    {{ isset($client) && $client->login_with_email ? 'checked' : '' }}
                    data-old-login-with-email="{{ isset($client) && $client->login_with_email ? 1 : 0 }}">

                <label for="login_with_email_client" class="custom-control-label">
                    <strong>Allow client to log in with email</strong> <span class="epic-tooltip"
                        data-toggle="tooltip"
                        title="Please ensure that if you change your email address that you change your username when logging in"><i
                            class="fa fa-question-circle"></i></span>
                </label>

            </div>
        </div>
        @error('login_with_email')
            <p class='text-danger inputerror'> {!! $errors->first('login_with_email') !!} </p>
        @enderror

        <div class="input-group input-group-static mt-4">
            <div class="form-check">
                <input type="checkbox" name="email_to_client" id="email_to_client" value="1"
                    class="form-check-input" {{ isset($client) && $client->email_to_client ? 'checked' : '' }}
                    data-old-email-to-client="{{ isset($client) && $client->email_to_client ? 1 : 0 }}">
                <label for="email_to_client" class="custom-control-label">
                    <strong>Send details to client email</strong> <span class="epic-tooltip" data-toggle="tooltip"
                        title="">

                    </span>
                </label>

            </div>
        </div>

        <div class="input-group input-group-static mt-4">
            {!! Form::label('numb', 'Please provide your phone number *', ['class' => 'strong ']) !!}
                    <span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left"
                        title="This is the primary contact detail for this specific client">
                        <i class="fa fa-question-circle"></i>
                    </span>
                    {!! Form::tel('numb', isset($client) ? $client->phonenumber : null, [
                        'class' => 'form-control countryCode numericField',
                        'maxlength' => '12',
                        'minlength' => '8',
                    ]) !!}
        </div>
        @error('numb')
            <p class='text-danger inputerror'> {!! $errors->first('numb') !!} </p>
        @enderror

        <div class="input-group input-group-static mt-4">
            {!! Form::label('client_notes', 'Client Notes', ['class' => 'strong']) !!}
            <span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left"
                title="This is notes relating to the client that may be relevant at a later date.">
                <i class="fa fa-question-circle"></i>
            </span>
            {!! Form::textarea('client_notes', isset($client->note) ? $client->note->cn_notes : null, [
                'class' => 'form-control',
                'cols'=>50,
                'rows'=>5
            ]) !!}       
        </div>
        @error('client_notes')
            <p class='text-danger inputerror'> {!! $errors->first('client_notes') !!} </p>
        @enderror



    </div>


</div>

<div class="row">
    <div class="col-md-6">
        <button type='submit' class="btn bg-gradient-dark btn-sm mt-6 mb-0">Save
            Changes</button>
    </div>
</div>
