#include <linux/module.h>
#include <linux/vermagic.h>
#include <linux/compiler.h>

MODULE_INFO(vermagic, VERMAGIC_STRING);

__visible struct module __this_module
__attribute__((section(".gnu.linkonce.this_module"))) = {
	.name = KBUILD_MODNAME,
	.init = init_module,
#ifdef CONFIG_MODULE_UNLOAD
	.exit = cleanup_module,
#endif
	.arch = MODULE_ARCH_INIT,
};

static const struct modversion_info ____versions[]
__used
__attribute__((section("__versions"))) = {
	{ 0x5c7202ab, __VMLINUX_SYMBOL_STR(module_layout) },
	{ 0x27761459, __VMLINUX_SYMBOL_STR(single_release) },
	{ 0x7b40fc97, __VMLINUX_SYMBOL_STR(seq_read) },
	{ 0x146da384, __VMLINUX_SYMBOL_STR(seq_lseek) },
	{ 0x85173fa9, __VMLINUX_SYMBOL_STR(proc_create_data) },
	{ 0x27e1a049, __VMLINUX_SYMBOL_STR(printk) },
	{ 0x56d4ca56, __VMLINUX_SYMBOL_STR(seq_printf) },
	{ 0xd2555f19, __VMLINUX_SYMBOL_STR(jiffies_64_to_clock_t) },
	{ 0xfe7c4287, __VMLINUX_SYMBOL_STR(nr_cpu_ids) },
	{ 0xc0a3d105, __VMLINUX_SYMBOL_STR(find_next_bit) },
	{ 0xb9249d16, __VMLINUX_SYMBOL_STR(cpu_possible_mask) },
	{ 0x3928efe9, __VMLINUX_SYMBOL_STR(__per_cpu_offset) },
	{ 0x891bef26, __VMLINUX_SYMBOL_STR(vm_stat) },
	{ 0x5567c227, __VMLINUX_SYMBOL_STR(kernel_cpustat) },
	{ 0xb138da1e, __VMLINUX_SYMBOL_STR(single_open) },
	{ 0xbdfb6dbb, __VMLINUX_SYMBOL_STR(__fentry__) },
};

static const char __module_depends[]
__used
__attribute__((section(".modinfo"))) =
"depends=";


MODULE_INFO(srcversion, "08DC0BAD5557146EE573BF2");
