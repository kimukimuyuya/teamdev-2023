# 環境構築手順

  1. mainブランチで以下を実行
  ```
  docker compose up -d --build
  ```
  2. tailwindが効いていない場合はターミナルで以下を実行
  ```
  npm run dev
  ```

# 画面遷移
## ユーザー画面
1. ランディングページ: localhost:8080/intro.php

2. エージェント企業選択画面: localhost:8080/index.php
<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/c5535ad3-605e-456b-a031-36d090b4f6a1">

<details>

<summary>実装した機能</summary>

- カート機能
- 絞り込み機能（総合型or特化型）
- 並び替え機能

</details>

## 管理者画面
- boozer(WEBサイト自体の管理者画面)
1. localhost:8080/boozer/index.phpに遷移（ログインメールアドレス: boozer@gmail.com, パスワード: password）
2. 新規登録ボタンからエージェントを登録
3. localhost:8025でメールの受信を確認

- client(就活エージェント企業側の管理者画面)
1. boozerから届いたメールを確認
2. URLをクリックしてパスワードを登録
3. ログイン画面よりログイン

## レスポンシブ対応
レスポンシブ対応はスマートフォン画面のみ対応しています
