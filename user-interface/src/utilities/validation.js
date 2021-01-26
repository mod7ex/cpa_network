class Field
{
    constructor(name = 'input', is_valid = true, val = null, errors = []){
        this.name = name
        this.is_valid = is_valid
        this.val = val
        this.errors = errors
    }

    reset(){
        this.is_valid = true
        this.errors = []
    }

    invalidate(msg){
        this.is_valid = false
        this.errors.push(msg)
    }

    serverInvalidate(errors){
        if(errors && errors.length){
            this.is_valid = false
            this.errors = errors
        }
    }

    require(msg){
        if(!this.val){
            this.invalidate(msg)
        }
        return this
    }

    min(k, msg){
        if(this.val && this.val.length < k){
            this.invalidate(msg)
        }
        return this
    }

    max(k, msg){
        if(this.val && this.val.length > k){
            this.invalidate(msg)
        }
        return this
    }

    isEmail(msg){
        let rx = new RegExp(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g)
        if(!rx.test(this.val)){
            this.invalidate(msg)
        }
        return this
    }

    sameAs(field, msg){
        if(this.val != field.val){
            this.invalidate(msg)
        }
        return this
    }
}

export default Field