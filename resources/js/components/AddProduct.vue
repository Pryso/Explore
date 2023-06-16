<template>
    <div class="main">
        <div class="content">
            <div class="category-prod">
                <div class="qwe-4">
                    <img :src="'../img/arrow.svg'">
                </div>
                <div class="qwe-6">
                    <span style="font-size: 20px; margin-bottom: 5px;">Добавить товар</span>
                </div>
            </div>
            <div class="prod-add">
                <div class="prod-info">
                    <div class="qwe-15">
                        <div class="form-input">
                            <label>Краткое описание</label>
                            <input type="text">
                        </div>
                        <div class="form-input">
                            <label>Полное описание</label>
                            <textarea type="text" rows="5"></textarea>
                        </div>

                        <div class="form-category">
                            <label>Категория</label>
                            <div class="qwe-17">
                                <div class="btn-2">Выберите игру</div>
                                <div class="btn-2">Выберите категорию</div>
                            </div>
                        </div>
                        <div class="form-input">
                            <label>Данные от аккаунта</label>
                            <textarea type="text" rows="3"></textarea>
                        </div>
                        <div class="form-input">
                            <label>Цена</label>
                            <div class="qwe-16">
                                <input type="number" placeholder="0">
                                <span>руб.</span>
                            </div>
                        </div>
                        <div class="form-success">
                            <div class="btn-4">
                                Добавить
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-img">
                    <span style="margin-bottom: 10px;">Загрузить фото <span style="color: #E0E0E0">(необязательно)</span></span>
                    <div class="img-container">Загрузить</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddProduct",
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
