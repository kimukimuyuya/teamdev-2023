# teamdev-2023

## 環境構築
- mainブランチでdocker compose up -d --buildを実行

## tailwind反映
- ターミナルでnpm run devを実行

## 画面遷移手順
### ユーザー画面
1. localhost:8080/intro.phpに遷移
2. 探してみるボタンを押す

### 管理者画面
- boozer
1. localhost:8080/boozer/index.phpに遷移（ログインメールアドレス: boozer@gmail.com, パスワード: password）
2. 新規登録ボタンからエージェントを登録
3. localhost:8025でメールの受信を確認

- client
1. boozerから届いたメールを確認
2. URLをクリックしてパスワードを登録
3. ログイン画面よりログイン

## レスポンシブ対応
レスポンシブ対応はスマートフォン画面のみ対応しています