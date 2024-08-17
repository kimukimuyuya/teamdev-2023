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

3. 個人情報入力画面
<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/4b191ccf-80a5-467f-805b-14b6d53f5b1a">

<details>

<summary>実装した機能</summary>

- 申し込んだ企業が自動入力される
- バリデーション機能

</details>

4.メールの受信: localhost:8025

<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/9cc02956-bee1-4a6f-b4b2-d556e6d1ab1e">

<details>

<summary>実装した機能</summary>

- mailhogを利用して仮想的にメールを送信する
  - ユーザーに申し込み完了メールの送信
  - 就活エージェント企業に、学生が申請したことを知らせるメールを送信

</details>


## 管理者画面((WEBサイト自体の管理者画面)
1. ログイン画面: localhost:8080/auth/login.php
```
ログインメールアドレス: boozer@gmail.com
パスワード: password
```
2. 新規登録ボタンからエージェントを登録
3. localhost:8025でメールの受信を確認

## 管理者画面(就活エージェント企業側の管理者画面)

- client(就活エージェント企業側の管理者画面)
1. boozerから届いたメールを確認
2. URLをクリックしてパスワードを登録
3. ログイン画面よりログイン

## レスポンシブ対応
レスポンシブ対応はスマートフォン画面のみ対応しています
