-- create文

CREATE TABLE admin (
  user_id INT PRIMARY KEY,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
) CHARSET=utf8;

DROP TABLE IF EXISTS students;
CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  name_kana VARCHAR(255) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(255) NOT NULL,
  gender CHAR(1) DEFAULT 0,
  university VARCHAR(255) NOT NULL,
  faculty VARCHAR(255) NOT NULL,
  graduate_year INT NOT NULL,
  prefecture VARCHAR(255) NOT NULL,
  created_at datetime default current_timestamp,
  updated_at datetime default current_timestamp
) CHARSET=utf8;

DROP TABLE IF EXISTS agents;
CREATE TABLE agents (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  company_name VARCHAR(255) NOT NULL,
  service_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255),
  image VARCHAR(255) NOT NULL,
  company_url VARCHAR(255) NOT NULL,
  service_url VARCHAR(255) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  start_at DATE,
  end_at DATE,
  type CHAR(1) DEFAULT 0,
  interview_location VARCHAR(255) NOT NULL,
  is_online BOOLEAN NOT NULL,
  specialization VARCHAR(255),
  created_at datetime default current_timestamp,
  updated_at datetime default current_timestamp,
  is_valid BOOLEAN default true
) CHARSET=utf8;

DROP TABLE IF EXISTS agents_students;
CREATE TABLE agents_students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  agent_id INT NOT NULL,
  is_valid BOOLEAN default true,
  FOREIGN KEY (student_id) REFERENCES students(id),
  FOREIGN KEY (agent_id) REFERENCES agents(user_id)
) CHARSET=utf8;
DROP TABLE IF EXISTS sort_items;
CREATE TABLE sort_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sort_item VARCHAR(255) NOT NULL
) CHARSET=utf8;

DROP TABLE IF EXISTS agents_items;
CREATE TABLE agents_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  agent_id INT NOT NULL,
  sort_id INT NOT NULL,
  rate INT NOT NULL,
  FOREIGN KEY (agent_id) REFERENCES agents(user_id),
  FOREIGN KEY (sort_id) REFERENCES sort_items(id)
) CHARSET=utf8;

DROP TABLE IF EXISTS areas;
CREATE TABLE areas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  area VARCHAR(255) NOT NULL
) CHARSET=utf8;

DROP TABLE IF EXISTS agents_areas;
CREATE TABLE agents_areas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  agent_id INT NOT NULL,
  area_id INT NOT NULL,
  FOREIGN KEY (agent_id) REFERENCES agents(user_id),
  FOREIGN KEY (area_id) REFERENCES areas(id)
) CHARSET=utf8;

DROP TABLE IF EXISTS agent_good;
CREATE TABLE agent_good (
  id INT AUTO_INCREMENT PRIMARY KEY,
  agent_id INT NOT NULL,
  good VARCHAR(255) NOT NULL,
  good_detail VARCHAR(255) NOT NULL,
  FOREIGN KEY (agent_id) REFERENCES agents(user_id)
) CHARSET=utf8;

DROP TABLE IF EXISTS agent_bad;
CREATE TABLE agent_bad (
  id INT AUTO_INCREMENT PRIMARY KEY,
  agent_id INT NOT NULL,
  bad VARCHAR(255) NOT NULL,
  FOREIGN KEY (agent_id) REFERENCES agents(user_id)
) CHARSET=utf8;

DROP TABLE IF EXISTS recommend;
CREATE TABLE recommend (
  id INT AUTO_INCREMENT PRIMARY KEY,
  agent_id INT NOT NULL,
  recommend VARCHAR(255) NOT NULL,
  FOREIGN KEY (agent_id) REFERENCES agents(user_id)
) CHARSET=utf8;

-- create文

-- insert文

insert into admin (user_id, email, password) values (1, "boozer@gmail.com", "$6$fd5263867dff5899$09HFUxE4i2I6xJVVC4ispP90rigtXEOWL6jHeDw3BS43TP9zvtRPlGABdPQnxJEhoiCQiqe8.QqD2B0FkY0Dg.");

insert into sort_items (sort_item) values ('おすすめ度'), ('求人力'), ('ES添削'), ('面接対策');

insert into areas (area) values ('全国'), ('北海道'), ('東北地方'), ('関東地方'), ('中部地方'), ('関西地方'), ('中国地方'), ('四国地方'), ('九州地方');

insert into agents (user_id, company_name, service_name, email, password, image, company_url, service_url, phone, start_at, end_at, type, interview_location, is_online, specialization) values 
(1, "株式会社DYM", "Meets Company", "meetscompany@gmail.com", "$6$b8fabeb73133943a$WElOLlmucatj10KUTfcImZp3ib/ynKO4/TitU2lc6kpIF2v0.4ZVB/tPzkUItmuekJ.QWAAU5DnpH65w4LucV/", "cuNY4iFN3FiQf6vPVeSJrfCh.png", "https://dym.asia/", "https://event.meetscompany.xyz/241/?utm_source=google&utm_medium=cpc&utm_campaign=search&gclid=CjwKCAjw1MajBhAcEiwAagW9MXynLq6zRhf2A5YK64fu6xiuJq5MCLcGR5iwx6A-wzOYw0Ic4EOANBoCCe8QAvD_BwE", "03-5745-0200", "2023-05-16", "2023-07-01", 0, "札幌・仙台・東京・名古屋・大阪・京都・広島・福岡", 1, NULL),
(2, "レバレージズ株式会社", "キャリアチケット", "careerticket@gmail.com", "$6$3d4795dcadd83758$bS5onJhX1l6d/j/iYsoFzth0lHVq2yxwyv98SqFyTX7K3himcL7gJ.6fkdaRavozLoL0jyaZ1C6euX3pxRs.A0", "top_ogp.jpg", "https://leverages.jp/", "https://careerticket.jp/", "03-5774-1632", "2023-05-20", "2023-08-31", 0, "東京、大阪、名古屋、横浜、福岡（5都市10支店）", 1, NULL),
(3, "株式会社リクルート", "リクナビ", "rikunabi@gmail.com", "$6$65287493c457c133$N0EGRpSyXDuYLDvEMsnT4NnK4DxT93K6hqu11IOGyed4nrQnAOdudmhoDiuU2IrSHCFgBmaLz0.Ah5ogFpmWy.", "S__30654472.jpg", "https://www.recruit.co.jp/", "https://job.rikunabi.com/2025/contents/article/edit~slp~brand01~index/u/?original=1&vos=ev25prap1000x0000017&gclid=CjwKCAjw1MajBhAcEiwAagW9Mb24qZwPSAZ7Lk170UshJ9GaD993zcdqm2R7ST3F2TU2RQNcd4Aj5hoC-FoQAvD_BwE", "03-6835-3000", "2023-04-25", "2023-06-30", 0, "東京", 0, NULL),
(4, "株式会社マイナビ", "マイナビ新卒紹介", "mainabi@gmail.com", "$6$b3e14f81c53291f4$sLKa9kGWuwE0SFTDq49azAP7daiSTrKAS6.xS507k2wHiBreAlBCePX.cKiMJQm3eFAu7NDSqwy2zEMr7GR.F1", "S__30654474.jpg", "https://www.mynavi.jp/", "https://shinsotsu.mynavi-agent.jp/", "03-6267-4000", "2023-05-01", "2023-10-10", 0, "北海道、宮城、福岡、埼玉、東京、神奈川、愛知、大阪、京都、兵庫、広島、石川", 0, NULL),
(5, "株式会社アーシャルデザイン", "アスリートエージェント", "athleteagent@gmail.com", "$6$3704d3354f175e9d$OGgPJUGU5pa/qXRDE1pqiebMOg8orfDsECqVEAf0P1v1I5IAvhqne0SAy2LpTQkLdIOCauJP1bkhYKT6VXajJ0", "S__30654475.jpg", "https://www.a-cial.com/about/", "https://www.a-cial.com/lp1/?affi=listing&gad=1&gclid=CjwKCAjw1MajBhAcEiwAagW9MYWQ9yFb4GDdY1YwN6ZYew3-rzG-wxCu-FQKHZJpHARWmAJQihWoRBoCF4cQAvD_BwE", "03-4546-8348", "2023-05-15", "2023-09-25", 1, "東京", 1, "体育会系"),
(6, "レバテック株式会社", "レバテック", "rebateck@gmail.com", "$6$5012b740a860b57b$lmqa2gFieHoQc61Waj/GRLwDTX/lU2SKH9mH34MwfxQnS5m8Cf1EXSpoqAF8R5RDWouaSvpOZwm5w/2KlzC7U/", "S__30654476.jpg", "https://levtech.jp/company/", "https://levtech.jp/", "03-5774-1762", "2023-05-18", "2023-09-30", 1, "東京、千葉、埼玉、神奈川、大阪、京都、兵庫、滋賀、奈良、和歌山、福岡", 1, "IT系");

insert into agents_items(agent_id, sort_id, rate) values 
(1, 1, 5),
(1, 2, 5),
(1, 3, 3),
(1, 4, 3),
(2, 1, 5), 
(2, 2, 4), 
(2, 3, 5),
(2, 4, 5),
(3, 1, 3),
(3, 2, 5),
(3, 3, 1),
(3, 4, 2),
(4, 1, 4),
(4, 2, 4),
(4, 3, 3),
(4, 4, 5),
(5, 1, 2),
(5, 2, 3),
(5, 3, 3),
(5, 4, 3),
(6, 1, 5),
(6, 2, 2),
(6, 3, 3),
(6, 4, 2);

insert into agents_areas(agent_id, area_id) values
(1, 1),
(2, 4),
(2, 5),
(2, 6),
(2, 9),
(3, 1),
(4, 1),
(5, 1),
(6, 4),
(6, 6),
(6, 9);

insert into agent_good(agent_id, good, good_detail) values
(1, "多様な企業と出会い、視野を広げられる", "特殊な中小企業から隠れた優良企業・有名企業など様々な企業がイベントには参加している。自分が名前を知っている大手企業しか見ず、視野が狭くなりがちな就職活動において、視野を広げる良いきっかけになること間違いなし！"),
(1, "イベント開催数随一の実績", "日本全国を中心に1000回以上開催されており、地方大学生も参加しやすい。オンラインでのイベントも充実している。そのため、自分の予定とイベント参加の両立もしやすいことも嬉しいポイントのひとつ！"),
(1, "企業の重要役職の方との関わり合いが多い", "Meets Companyの「座談会」はフランクな雰囲気の少人数制で運営されており、人事の方などに気軽に質問ができる。また、その後のグループディスカッションや自己PRの時間で活躍できれば良いアピールになり、実際の選考に向けた練習や人事の方からのフィードバックを貰う機会にもなるため、参加しないのはもったいない！"),
(2, "数打ちゃ当たる精神はもう終わり！", "「量より質」を重視しているため、学生一人ひとりの価値観に合致した本当に相性の良い企業のみを紹介してくれる。一人あたりの学生に対する平均紹介企業社数は5社程度とかなり激選されているため、無駄な労力を割く必要がない！"),
(2, "最短2週間のスピード内定が可能", "企業紹介から選考に使用する書類の作成、企業との日程調整までの全てを学生に代わり、一人ひとりにつく担当アドバイザーが行うため、慣れない作業に手間取ることがない。また、担当者が就活生の魅力を企業側にアピールしてくれることで通常選考よりも早い段階で内定を得られる！"),
(2, "ブラック企業は排除済み", "しっかりと調査を行い、キャリアチケット社員が足を運んで確認した企業のみしか紹介されないため、ブラック企業・労働条件が悪い企業などの悪質な企業は紹介されない！"),
(3, "履歴書一枚で就活スタート！", "リクナビ独自のサービスである「OpenES」に登録して１枚のESを仕上げると、4000社以上もの企業に同じESを勝手に提出してくれる。このESは企業が自由に閲覧でき、魅力的なESであれば人事担当者からスカウトを受けることある！"),
(3, "求人が高い頻度で更新される", "リクナビでは１週間に２回（水曜日と金曜日）に求人情報が更新されるシステムになっており、新しい優良企業の求人をチェックしやすい！"),
(3, "多数のニーズに答えられる質の高い企業の多さ", "幅広い業種はもちろんのこと、大手企業からベンチャー企業、都市部から地方まで、他の就活エージェントには載っていない求人も含めて圧倒的な多さを誇っている。コロナ禍で増えたニーズにも対応しており、希望の求人が必ずあること間違いなし！"),
(4, "地方でも満足できる就活サポートが受けられる", "他の種かつエージェント期比べて面談場所が多く、関東件以外の学生でも対面利用することができる大手人材紹介サービスの一つ。サポートも手厚いため、地方学生だからという理由で就活を妥協する必要がなくなる！"),
(4, "内定獲得の確率が高い企業しか紹介されない", "大企業との繋がりが他社より多いかつ強固という点を活かし、就活生それぞれの適性と希望から、その就活生にピッタリ合った企業を紹介してくれる。内定をしっかり獲得できるかどうかも考慮した上で紹介するため、内定率が高いことも特徴！"),
(4, "専領域に特化したアドバイザーから情報を得ることができる", "マイナビ新卒紹介では、１人のアドバイザーが全ての職種・業界を希望する就活生を担当するのではなく、自分の専門領域を希望する就活生を担当するシステムを徹底している。一般的な就活対策はもちろん、興味のある業界の裏情報までしっかり教えてもらうことができる！"),
(5, "アスリート人材を中心に多くの体育会系学生が利用", "あえてスポーツに打ち込んできた人に限定したキャリアサポートを手掛けていることから、競技経験者の採用意欲が非常に高い企業ばかり。体育会系を積極採用したいと考える企業と出会うことができるため、体育会系学生は必須登録しておくべき！"),
(5, "スポーツ経験のある就活生ならではの悩みや希望に寄り添った対応をしてもらえる", "「競技という狭い世界で生きてきたのに、いきなり就職活動とか言われても何も分からなくて不安しかない…」「選手・競技生活をいつまで続けよう…」などの体育会系学生あるあるのお悩みに親身に寄り添った対応をしてくれる！"),
(5, "地方でも利用しやすい", "アスリートエージェントは、地方の学生のために出張面談を行っている。部活や練習などで忙しい地方学生や時間的・金銭的問題などで面談の機会を得ることが難しいという学生などへの細やかなサポートが受けられることも大きな魅力！"),
(6, "大手企業のエンジニアを目指す就活生なら利用必須", "「他の大手転職エージェントと比べると求人が少ない」と評判されているが、実態はハイクラス向け求人が大半を占めており、大手企業の繋がりも深いため、ハイキャリアを目指すなら登録しておいて損はない！"),
(6, "確実に良質な求人を紹介してもらえる", "エンジニア経験者層かつスキルが磨かれていればいるほど紹介求人数や決定率が高く、高収入求人を獲得できる可能性が高い！"),
(6, "プロのコンサルタントからカウンセリングやアドバイスを受けられる", "担当アドバイザーのIT関連の基礎知識や個人に応じた転職先企業の情報量が多い。ヒアリングも細かいため、真摯な対応で手厚いサポートを受けられると評判になっている！");

insert into agent_bad(agent_id, bad) values
(1, "希望していない求人も紹介される"),
(1, "イベントに参加する企業は非公開"),
(1, "電話やSNSでの勧誘がしつこい場合がある"),
(2, "アドバイザーが紹介した企業にしかエントリーできない"),
(2, "超大手企業とのコネクションは薄い"),
(2, "首都圏・大都市以外は対面カウンセリングが受けにくい (オンライン面談は可)"),
(3, "良い求人や企業とコネクションを持ちにくい"),
(3, "利用者が多いためサポートが手薄で受けにくい"),
(3, "求人が多すぎて絞り込みが大変"),
(4, "求人が多い分、紹介される企業の質に大きな差がある"),
(4, "自分に合わない企業も多く紹介される"),
(4, "学歴によって選考を受けられる企業が大きく異なる"),
(5, "体育会系のイメージで営業職を多く勧められる"),
(5, "求人数が限られている"),
(5, "紹介求人の多くの勤務地が首都圏か関西中心に限られている"),
(6, "未経験向きでない（実務経験が必須）"),
(6, "サポートが困難なユーザーにはかなりドライ"),
(6, "対応地域がかなり限定的");

insert into recommend(agent_id, recommend) values
(1, "いろんな企業を紹介してほしい、視野を広げたい方"),
(1, "イベントに沢山参加して、実際に働いている人から社風を聞きたい方") ,
(2, "質の高いサポートを受けたい方"),
(2, "対応地域に在住している方"),
(3, "自分の学歴に自信がある・明確な目的がある方"),
(3, "サポートではなく、良い企業を知りたい方"),
(4, "内定を確実に取りたい方"),
(4, "専門知識を持つプロのキャリアアドバイザーからアドバイスをもらいたい方"),
(5, "体育会系だった・アスリート人材に興味がある方"),
(5, "地方在住で将来的に首都圏で就職を考えている方"),
(6, "転職希望者や年収・キャリアアップを目的としている方"),
(6, "プログラムング等の実務経験がある人");

insert into students (id, name, name_kana, phone, email, gender, university, faculty, graduate_year, prefecture) values 
(1, "野呂美智子", "ノロミチコ", "09003150175", "michikosocool1@gmail.com", "1", "立教大学", "経営学部経営学科", "2026", "青森県"),
(2, "森はるか", "モリハルカ", "07011177700", "moriharumaru@gmail.com", "1", "慶應義塾大学", "文学部人文社会学科", "2026", "神奈川県"),
(3, "岩城和輝", "イワギカズキ", "08000002222", "kazukazusocute@gmail.com", "0", "慶應義塾大学", "経済学部経済学科", "2026", "東京都"),
(4, "塚越雄真", "ツカコシユウマ", "01228284949", "tsukachanikemen@gmail.com", "0", "慶應義塾大学", "理工学部情報工学科", "2026", "埼玉県"),
(5, "辻建世", "ツジケンセイ", "06044335551", "dokodemozukken@gmail.com", "0", "慶應義塾大学", "経済学部経済学科", "2026", "東京都"),
(6, "平手美羽", "ヒラテミウ", "05024681357", "hirahiramaru@gmail.com", "1", "慶應義塾大学", "法学部政治学科", "2026", "東京都"),
(7, "鈴木大騎", "スズキタイキ", "02366669999", "ryunenkaihidaze@gmail.com", "0", "慶應義塾大学", "商学部商学科", "2026", "愛知県"),
(8, "小野媛乃", "オノヒナノ", "04601013399", "nyugakushikigannba@gmail.com", "1", "慶應義塾大学", "理工学部管理工学学科", "2026", "岡山県"),
(9, "上野侑紗", "ウエノアリサ", "08067254989", "arisamadidetennshi@gmail.com", "1", "慶應義塾大学", "理工学管理工学科部", "2026", "東京都"),
(10, "神野豪気", "カンノゴウキ", "03011027074", "goukunogenkidesuka@gmail.com", "0", "慶應義塾大学",  "法学部政治学科", "2026", "東京都"),
(11, "竹内菜月", "タケウチナツキ", "05018183945", "saikonimegami@gmail.com", "1", "慶應義塾大学", "法学部政治学科", "2026", "東京都"),
(12, "一条雫", "イチジョウシズク", "02579655521", "kakuunozinbutsu@gmail.com", "1", "上智大学", "神学部神学科", "2025", "京都府"),
(13, "小野田優希", "オノダユウキ", "06011338905", "kakuunootokonoko@gmail.com", "0", "青山学院大学", "地球社会共生学部地球社会共生学科", "2024", "群馬県"),
(14, "古山智司", "フルヤマサトシ", "04588254619", "kakuunobisyounen@gmail.com", "0", "国士舘大学", "体育学部こどもスポーツ教育学科", "2026", "高知県"),
(15, "熊谷明日花", "クマガイアスカ", "03865318804", "kakuunoonnanoko@gmail.com", "1", "国士舘大学", "21世紀アジア学部21世紀アジア学科", "2026", "石川県"),
(16, "酒井響", "サカイヒビキ", "01072579876", "kakuunobisyouzyo@gmail.com", "1", "早稲田大学", "文化構想学部文化構想学科表象・メディア論系", "2025", "秋田県"),
(17, "鳳雅秀", "オオトリマサヒデ", "05378917726", "kakuunomiyabidanshi@gmail.com", "0", "東京大学", "医学部医学科", "2024", "島根県");

insert into agents_students (id, student_id, agent_id) values 
(1, 2, 1),
(2, 3, 1),
(3, 4, 1),
(4, 6, 1),
(5, 8, 1),
(6, 12, 1),
(7, 13, 1),
(8, 15, 1),
(9, 1, 2),
(10, 4, 2),
(11, 5, 2),
(12, 7, 2),
(13, 9, 2),
(14, 10, 2),
(15, 11, 2),
(16, 14, 2),
(17, 15, 2),
(18, 16, 2),
(19, 17, 2),
(20, 1, 3),
(21, 3, 3),
(22, 7, 3),
(23, 13, 3),
(24, 14, 3),
(25, 17, 3),
(26, 1, 4),
(27, 2, 4),
(28, 4, 4),
(29, 6, 4),
(30, 7, 4),
(31, 8, 4),
(32, 10, 4),
(33, 11, 4),
(34, 12, 4),
(35, 15, 4),
(36, 16, 4),
(37, 17, 4),
(38, 3, 5),
(39, 5, 5),
(40, 13, 5),
(41, 14, 5),
(42, 16, 5),
(43, 3, 6),
(44, 4, 6),
(45, 5, 6),
(46, 8, 6),
(47, 9, 6),
(48, 10, 6),
(49, 11, 6),
(50, 15, 6),
(51, 16, 6);


