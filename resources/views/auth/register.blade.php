<div id="popup-registration" class="popup popup-registration">
    <div class="popup-title">Регистрация</div>
    <form action="{{ route('register') }}"  class="form-validate">
        @csrf
        <div class="form-inline">
            <div class="form-group">
                <input type="email" name="email" required class="form-control" value="{{ old('email') }}" placeholder="panyakin@mail.com" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="password"  class="form-control" placeholder="Пароль">

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Повторите пароль" >
            </div>
        </div>
        <div class="form-group form-agreement">
            <input type="checkbox" name="agreement" id="agreement-register" class="checkbox checkbox--toggle">
            <label for="agreement-register">Я согласен с <a href="#">условиями обработки данных</a> на данном сайте</label>
        </div>
        <div class="form-group form-buttons">
            <button type="submit" class="btn btn--grey btn-register">
                <span>Зарегистрироваться</span>
            </button>
        </div>
    </form>

</div>
