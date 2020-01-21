# venv\Script\activate


from faker import Faker
import pymysql
from slugify import slugify
from dotenv import load_dotenv, find_dotenv
import os

load_dotenv(find_dotenv())

faker = Faker("fr_FR")

connection = pymysql.connect(host=os.getenv("DB_HOST_PY"),
    user=os.getenv("DB_USER_PY"),
    password=os.getenv("DB_PASS_PY"),
    db=os.getenv("DB_NAME_PY"),
    charset='utf8mb4',
    cursorclass=pymysql.cursors.DictCursor)

with connection:
    cur = connection.cursor()
    for _ in range(100):
        sql = "INSERT INTO User(nom, prenom, age, email) VALUES (%s, %s, %s, %s)"
        cur.execute(sql, (faker.first_name(),
            faker.last_name(),
            faker.pyint(min_value=15, max_value=85, step=1),
            faker.simple_profile(sex=None)["mail"]))

    for _ in range(500):
        sql = "INSERT INTO Article(titre, contenu, date, slug, user_id) VALUES (%s, %s, %s, %s, %s)"
        titre = faker.text(max_nb_chars=50, ext_word_list=None)
        cur.execute(sql, (titre, faker.text(max_nb_chars=600, ext_word_list=None),
            faker.date(pattern="%Y-%m-%d", end_datetime=None),
            slugify(titre),
            faker.pyint(min_value=1, max_value=100, step=1)))

connection.commit()